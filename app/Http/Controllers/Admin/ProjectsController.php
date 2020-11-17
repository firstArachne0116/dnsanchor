<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\ConfirmProject;
use App\Http\Requests\Admin\Project\DestroyProject;
use App\Http\Requests\Admin\Project\IndexProject;
use App\Http\Requests\Admin\Project\StoreProject;
use App\Http\Requests\Admin\Project\UpdateProject;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectInvoiceLine;
use App\Models\PurchaseOrder;
use App\Models\Template;
use App\Notifications\ProjectAwaitingApproval;
use App\Models\AdminUser;
use Brackets\AdminListing\Facades\AdminListing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Media;
use function App\Helpers\create_pdf_from_project;
use function App\Helpers\get_invoice_line_items;

class ProjectsController extends Controller {

    public function getListing( $request ) {
        return AdminListing::create( Project::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ 'id', 'title' ]
        );
    }

    public function getListing1( Request $request ) {
        return $this->getListing($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexProject $request
     *
     * @return Response|array
     */
    public function index( IndexProject $request ) {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        if ( $request->ajax() ) {
            return [ 'data' => $data ];
        }

        return view( 'admin.project.index', [
            'data'                  => $data,
            'project_types'         => \App\Http\Resources\ProjectTypeResource::collection( \App\Models\ProjectType::all() )->toArray( $request ),
            'aa_content' => Template::where( 'key', 'aa-template' )->firstOrFail()->content,
            'blank_invoice_listing' => json_encode(
                [
                    'data'           => [],
                    'current_page'   => 1,
                    'first_page_url' => '',
                    'last_page_url'  => '',
                    'next_page_url'  => null,
                    'prev_page_url'  => null,
                    'path'           => '',
                    'from'           => 0,
                    'per_page'       => 10,
                    'to'             => 0,
                    'total'          => 0,
                ] )
        ] );

    }

    public function purchase_orders( Request $request, Project $project ) {
        AdminListing::create( PurchaseOrder::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ 'id', 'title' ],

            function( $query ) use ($project) {
                $query->where( 'project_id', $project->id );
            }
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create( Request $request ) {
        $this->authorize( 'admin.project.create' );

        $project_types = \App\Http\Resources\ProjectTypeResource::collection( \App\Models\ProjectType::all() )->toArray( $request );

        $id = -1;

        if ($request->has('id')) {
            $id = $request->input('id');
        }

        return view( 'admin.project.index', [
            'data'                  => $this->getListing( request() ),
            'project_types'         => $project_types,
            'create'                => true,
            'customer_id'           => $id,
            'aa_content' => Template::where( 'key', 'aa-template' )->firstOrFail()->content,
            'blank_invoice_listing' => json_encode(
                [
                    'data'           => [],
                    'current_page'   => 1,
                    'first_page_url' => '',
                    'last_page_url'  => '',
                    'next_page_url'  => null,
                    'prev_page_url'  => null,
                    'path'           => '',
                    'from'           => 0,
                    'per_page'       => 10,
                    'to'             => 0,
                    'total'          => 0,
                ] )
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProject $request
     *
     * @return Response|array
     */
    public function store( StoreProject $request ) {
        // Sanitize input
        $sanitized = $request->validated();

//        $con                      = $sanitized[ 'contact_id' ];
//        $sanitized[ 'client_id' ] = $con;

//        unset( $sanitized[ 'contact_id' ] );

        $sanitized[ 'status' ]  = 'DRAFT_VERSION';
        $sanitized[ 'user_id' ] = $request->user()->id;

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }

        // Store the Project
        $project = Project::create( $sanitized );

        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) ) {
                    return $item[ 'ID' ];
                }
            }, $assigned_salespeople );

            $project->sales_persons()->sync( $ids );
        }

        if ( isset( $project[ 'types' ] ) ) {
            $types = $project[ 'types' ];

            unset( $project[ 'types' ] );

            $project[ 'fields' ] = json_encode( $types );
        }

        if ( $request->ajax() ) {
            return [
                'success' => true,
                'resource' => $project->toArray(),
                'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' )
            ];
        }

        return redirect( 'admin/projects' );
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, Project $project ) {
        $this->authorize( 'admin.project.show', $project );

        if ( $request->ajax() ) {
            return new ProjectResource( $project );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit( Request $request, Project $project ) {
        $this->authorize( 'admin.project.edit', $project );

        $latest_project_version = $project;

        // spoof project ID
        $latest_project_version->version_id = $latest_project_version->id;
        $latest_project_version->id         = $project->id;

        $project_types = \App\Http\Resources\ProjectTypeResource::collection( \App\Models\ProjectType::all() )->toArray( $request );

        return view( 'admin.project.index', [
            'active_record'         => ( new ProjectResource( $project ) )->toArray( request() ),
            'data'                  => $this->getListing( request() ),
            'project_types'         => $project_types,
            'aa_content' => Template::where( 'key', 'aa-template' )->firstOrFail()->content,
            'blank_invoice_listing' => json_encode(
                [
                    'data'           => [],
                    'current_page'   => 1,
                    'first_page_url' => '',
                    'last_page_url'  => '',
                    'next_page_url'  => null,
                    'prev_page_url'  => null,
                    'path'           => '',
                    'from'           => 0,
                    'per_page'       => 10,
                    'to'             => 0,
                    'total'          => 0,
                ] )
        ] );
    }

    public function fcq_signed( Request $request, Project $project ) {
        $fcq_count = Project::drafts()
                          ->where( 'base_project_id', '=', $project->id )
                          ->official()
                          ->whereType( 'fcq' )
                          ->latestVersion()
                          ->count();

        if ( $fcq_count > 0 ) {
            $project->update([
                'fcq_signed_at' => Carbon::now(),
            ]);

            return response()->json( [ 'success' => true ] );
        }

        return response()->json( [ 'success' => true ] );
    }

    public function saveAsOfficial( ConfirmProject $request, Project $project ) {
        // Sanitize input
        $sanitized = $request->validated();

        $project->template_type = null;
        $project->status = 'DRAFT_VERSION';

        if ( $sanitized[ 'approved' ] ) {
            $key = null;

            switch( strtolower( $sanitized[ 'template_type' ] ) ) {
                case 'rfq':
                    $key = 'RFQ';
                    break;
                case 'pcq':
                    $key = 'PCQ';
                    break;
                case 'fcq':
                    $key = 'FCQ (signed) + 2 docs sent';
                    break;
            }

            if ( $key ) {
                $copy = $project->project_stage_checklist;

                foreach ( $copy as $index => $item ) {
                    if ( isset( $item[ 'label' ] ) && $item[ 'label' ] === $key ) {
                        $copy[ $index ][ 'checked' ] = true;
                        $copy[ $index ][ 'has_official_version' ] = true;
                        $copy[ $index ][ 'timestamp' ] = Carbon::now()->getTimestamp();
                    }
                }

                $project->project_stage_checklist = $copy;
            }
        }

        $project->save();

        // Archive for records...
        $draft = $project->duplicate();

        $draft->fill( [
            'base_project_id' => $project->id,
            'template_type'   => $sanitized[ 'template_type' ],
            'approved_at'     => Carbon::now(),
            'approved_by'     => $request->user()->id,
            'status'          => $sanitized[ 'approved' ] ? 'OFFICIAL_VERSION' : 'REJECTED',
        ] )->save();

        // create PDF
        if ( $sanitized[ 'approved' ] ) {
            create_pdf_from_project( $project->id, $sanitized[ 'template_type' ], true );
        }

        // flush cached permissions
        Cache::forget( sprintf( '%s-%s-approved', $project->id, $sanitized[ 'template_type' ] ) );

        return response()->json( [
            'success' => true,
            'ID'      => $project->id,
            'status'  => $project->status,
        ] );
    }

    public function download_all_files( Request $request, Project $project ) {
        # enable output of HTTP headers
        $options = new \ZipStream\Option\Archive();
        $options->setSendHttpHeaders( true );

        # create a new zipstream object
        $zip = new \ZipStream\ZipStream( sprintf( '%s-All-Files.zip', $project->title ), $options );

        foreach ( $project->media as $media ) {
            # add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
            $zip->addFileFromPath( $media->file_name, $media->getPath() );
        }

        # finish the zip stream
        $zip->finish();
    }

    public function remove_file( Request $request, Project $project ) {
        $validator = Validator::make( $request->all(), [
            'media_id' => [ 'required', 'int', 'exists:media,id' ],
        ]);

        $media = (int) $request->input( 'media_id' );

        $project->media()->where( 'id', $media )->delete();

        return response()->json( [ 'success' => true ] );
    }

    public function upload_files( Request $request, $project_id ) {
        if ( ! $request->has( 'field' ) || ! $request->input( 'field' ) ) {
            return response()->json( [ 'success' => false ] );
        }

        // no drafts exist
        $project = Project::findOrFail( $project_id );

        $media = $project->addMediaFromRequest( 'file' )
                         ->withCustomProperties( [ 'field' => $request->input( 'field' ) ] )
                         ->toMediaCollection( 'jcp_supporting_files' );

        return response()->json( [
            'success' => true,
            'data'    => array_merge( [], $media->toArray(), [ 'url' => asset( $media->getUrl() ) ] )
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProject $request
     * @param Project       $project
     *
     * @return Response|array
     */
    public function update( UpdateProject $request, Project $project ) {
        // Sanitize input
        $sanitized         = $request->validated();
        $saved_as_official = $request->input( 'saved_as_official' );

        $editable_project = $project;

        if ( $saved_as_official ) {
            // mark project as waiting for manager approval
            $sanitized[ 'status' ] = 'AWAITING_MANAGER_APPROVAL';

            // alert managers that there is a project awaiting to be approved
            $managers = AdminUser::whereHas( 'roles', function ( $q ) {
                $q->where( 'name', 'Manager' );
            } )->get();

            if ( env( 'ENABLE_NOTIFICATIONS' ) ) {
                Notification::send( $managers, new ProjectAwaitingApproval( $project, $request->user() ) );
            }
        }

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }

        // don't autoprocess media
        \Config::set( 'media-collections.auto_process', false );

        // update main project
        $editable_project->update( $sanitized );


        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) ) {
                    return $item[ 'ID' ];
                }
            }, $assigned_salespeople );

            $project->sales_persons()->sync( $ids );
        }

//        // then create an "archived" version
//        if ( $saved_as_official ) {
//            create_draft_from_project( $project, $request->input( 'template_type' ) );
//        }

        if ( $request->ajax() ) {
            return response()->json( [ 'success' => true, 'resource' => $project->toArray(), 'ID' => $project->id, 'status' => $project->status ] );
        }

        return redirect( 'admin/projects' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProject $request
     * @param Project        $project
     *
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy( DestroyProject $request, Project $project ) {
        $project->delete();

        if ( $request->ajax() ) {
            return response( [ 'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' ) ] );
        }

        return redirect()->back();
    }

}
