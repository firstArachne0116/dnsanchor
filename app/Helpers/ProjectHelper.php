<?php

namespace App\Helpers;

use App\Models\LetterHead;
use App\Models\Project;
use App\Models\ProjectInvoiceLine;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderInvoiceLine;
use App\Notifications\ProjectAwaitingApproval;
use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

function broadcast_to_role( $role, $notification ) {
    $collection = \App\Models\AdminUser::whereHas( 'roles', function ( $q ) use ( $role ) {
        $q->where( 'name', $role );
    } )->get();

    if ( $collection->count() > 0 ) {
        if ( env( 'ENABLE_NOTIFICATIONS' ) ) {
            Notification::send( $collection, $notification );
        }
    }
}

function get_view_from_project_type($type) {
    $view = null;

    switch ( strtolower( $type ) ) {
        case 'rfq':
            $view = 'admin.project.export.rfq';
            break;
        case 'pcq':
            $view = 'admin.project.export.pcq';
            break;
        case 'fcq':
            $view = 'admin.project.export.fcq';
            break;
        case 'aa':
            $view = 'admin.project.export.aa';
            break;
        case 'jcw':
            $view = 'admin.project.export.jcw';
            break;
        case 'po':
            $view = 'admin.project.export.po';
            break;
        case 'sales_invoice':
            $view = 'admin.project.export.sales_invoice';
            break;
        case 'misc-po':
            $view = 'admin.project.export.misc_po';
            break;
        case 'jcc':
            $view = 'admin.project.export.jcc';
            break;
    }

    return $view;
}

function create_pdf_from_project($project_id, $type, $save_only = false, $file_name = null ) {
    $project = Project::drafts()
                      ->where( 'base_project_id', '=', $project_id )
                      ->official()
                      ->whereType( $type )
                      ->latestVersion()
                      ->first();

    if ( ! $project || ! $project->count() === 0 ) {
        // no drafts exist
        $project = Project::findOrFail( $project_id );
    }

    if ( $view = get_view_from_project_type( $type ) ) {
        $print = false;
        $letterhead = null;
        $po = null;

        if ( request()->has( 'letterhead' ) && ! in_array( request()->input( 'letterhead' ), [
                'null',
                null,
                '-1'
            ] ) ) {
            $letterhead = LetterHead::find( (int) request()->input( 'letterhead' ) );
        }

        if ( request()->has( 'po' ) ) {
            $po = PurchaseOrder::findOrFail( 1 );
        }

        if ( strtolower( $type ) === 'aa' ) {
            /**
             * Replace AA shortcodes
             */

            $aa_template = $project->aa_template;

            $aa_template = str_replace( '[SIGNED_FCQ_DATE]', $project->fcq_signed_at->format( 'm/d/Y' ), $aa_template );
            $aa_template = str_replace( '[FCQ_SIGNED_DATE]', $project->fcq_signed_at->format( 'm/d/Y' ), $aa_template );
            $aa_template = str_replace( '[TODAYS_DATE]', Carbon::now()->format( 'm/d/Y' ), $aa_template );

            $pdf = \PDF::loadView( $view, compact( 'project', 'print', 'letterhead', 'aa_template' ) );
        } else {
            $pdf = \PDF::loadView( $view, compact( 'project', 'print', 'letterhead', 'po' ) );
        }


        /**
         * @var $pdf \Barryvdh\DomPDF\PDF
         */

        if ( $save_only ) {
            if ( $project->status === 'OFFICIAL_VERSION' ) {
                // Document media
                if ( $file_name ) {
                    $path = storage_path( sprintf( 'projects/%s/%s-%s-%s.pdf', $project_id, $type, Carbon::now()->format( 'Y-m-d H-i-s' ), str_slug( $file_name ) ) );
                } else {
                    $path = storage_path( sprintf( 'projects/%s/%s-%s.pdf', $project_id, $type, Carbon::now()->format( 'Y-m-d H-i-s' ) ) );
                }

                $directory_path = storage_path( sprintf( 'projects/%s/', $project_id ) );

                if ( ! File::exists( $directory_path ) ) {
                    File::makeDirectory( $directory_path );
                }

                $file = File::put( $path, $pdf->output() );

                Project::findOrFail( $project_id )->addMedia( $path )->toMediaCollection( 'official_files' );
            }
        } else {
            if ( request()->has( 'download' ) ) {
                return $pdf->download( 'project.pdf' );
            } else {
                return $pdf->stream();
            }
        }
    }
}

/**
 * @param \App\Models\Project $project
 *
 * @return \App\Models\Project
 */
function get_latest_project_version( Project $project ) {
    $drafts = Project::query()->drafts()->orderByRaw(
        DB::raw( "FIELD(template_type, 'JCW', 'AA', 'Misc PO', 'PO', 'JCP', 'FCQ', 'PCQ', 'RFQ')" )
    )->first();

    return $drafts ?: $project;
}

function reference_generator( Project $project ) {
    $user_id = $project->user_id;

    if ( $user_id < 10 ) {
        $user_id = '0' . $user_id;
    }

    return sprintf( '%s-%s', $user_id, Carbon::now()->getTimestamp() );
}

function transform_specification_name( $name ) {
    return ucwords( implode( ' ', explode( '_', $name ) ) );
}

/**
 * @param \App\Models\Project $project
 * @param null                $template_type
 *
 * @return \App\Models\Project
 */
function get_latest_project_version_for_type( Project $project, $template_type = null ) {
    return get_latest_editable_project_version_for_type( $project, $template_type, true, true );
}

/**
 * @param \App\Models\Project $project
 * @param null                $template_type
 * @param bool                $include_officials
 * @param bool                $allow_original
 *
 * @return \App\Models\Project
 */
function get_latest_editable_project_version_for_type( Project $project, $template_type = null, $include_officials = false, $allow_original = true ) {
    $has_drafts = $project->children()->whereType( $template_type )->count() !== 0;

    // create draft version if has none
    if ( ! $has_drafts ) {
        if ( $allow_original ) {
            return $project;
        }

        return create_draft_from_project( $project, $template_type );
    } else {
        // check if has non-official draft available
//        $draft = $project->children()->drafts()->whereType( $template_type )->whereStatusIn( [
//            'DRAFT_VERSION',
//            'AWAITING_MANAGER_APPROVAL'
//        ] )->latestVersion()->first();
//
//        if ( $draft ) {
//            // has available draft we can save
//            return $draft;
//        }

        if ( $include_officials ) {
            // check if has official version
            $official = $project->children()->official()->whereType( $template_type )->latestVersion()->first();

            if ( $official ) {
                return $official;
            }
        }

        // doesn't have official nor non-official version, create a draft...
        if ( $allow_original ) {
            return $project;
        }

        return create_draft_from_project( $project, $template_type );
    }
}

/**
 * @param \App\Models\Project $project
 * @param                     $template_type
 *
 * @return bool
 */
function has_approved_template_type( Project $project, $template_type ) {
//    return Cache::remember( sprintf( '%s-%s-approved', $project->id, $template_type ), Carbon::now()->addMinutes( 60 ), function() use( $project, $template_type ) {
        return $project->children()->official()->whereType( $template_type )->latestVersion()->first() !== null;
//    });
}

/**
 * @param \App\Models\Project $project
 * @param                     $template_type
 *
 * @return \App\Models\Project
 */
function create_draft_from_project( Project $project, $template_type ) {
    $draft = $project->duplicate();

    $draft->fill( [
        'base_project_id' => $project->id,
        'template_type'   => $template_type,
        'approved_at'     => null,
        'approved_by'     => null,
        'status'          => 'DRAFT_VERSION',
    ] )->save();

    return $draft;
}

function get_invoice_line_items( Project $project, $query = null, $filters = [] ) {
    if ( ! $query ) {
        $query = ProjectInvoiceLine::query();
    }

    $query->whereHas( 'project', function ( Builder $query ) use ( $project, $filters ) {
        if ( isset( $filters[ 'category' ] ) && $filters[ 'category' ] ) {
            switch( strtolower( $filters[ 'category' ] ) ) {
                case 'aa':
                case 'aa change orders':
                    $query->where( 'category', 'AA Change Orders' );
                    break;
            }
        } else {
            /**
             * Remove any categories (such as AA Change Orders) unless
             * manually requested. This is because we don't need them
             * in the RFQ/PCQ/FCQ stages.
             */
            $query->whereNotIn( 'category', [ 'AA Change Orders' ] );
        }

        /**
         * Target latest version of the project
         */
        $query->where( 'project_id', $project->id );

        return $query->latestVersion();
    } );

    return $query;
}

function get_purchase_order_line_items( PurchaseOrder $purchaseOrder, $query = null, $filters = [] ) {
    if ( ! $query ) {
        $query = PurchaseOrderInvoiceLine::query();
    }

    $query->whereHas( 'purchase_order', function ( Builder $query ) use ( $purchaseOrder, $filters ) {
        if ( isset( $filters[ 'category' ] ) && $filters[ 'category' ] ) {
            switch( strtolower( $filters[ 'category' ] ) ) {
                case 'aa':
                case 'aa change orders':
                    $query->where( 'category', 'AA Change Orders' );
                    break;
            }
        } else {
            /**
             * Remove any categories (such as AA Change Orders) unless
             * manually requested. This is because we don't need them
             * in the RFQ/PCQ/FCQ stages.
             */
            $query->whereNotIn( 'category', [ 'AA Change Orders' ] );
        }

        /**
         * Target latest version of the project
         */
        $query->where( 'purchase_order_id', $purchaseOrder->id );

        return $query->latestVersion();
    } );

    return $query;
}
