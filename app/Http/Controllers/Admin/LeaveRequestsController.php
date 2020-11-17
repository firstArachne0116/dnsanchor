<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessLogResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\LeaveRequest\IndexLeaveRequest;
use App\Http\Requests\Admin\LeaveRequest\StoreLeaveRequest;
use App\Http\Requests\Admin\LeaveRequest\UpdateLeaveRequest;
use App\Http\Requests\Admin\LeaveRequest\DestroyLeaveRequest;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\DB;
use function App\Helpers\broadcast_to_role;

class LeaveRequestsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param IndexLeaveRequest $request
     *
     * @return Response|array
     */
    public function index( IndexLeaveRequest $request ) {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create( LeaveRequest::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ '' ],

            function( $query ) use ( $request ) {
                $query->where( 'user_id', $request->user()->id );
            }
        );

        if ( $request->ajax() ) {
            if ( $request->has( 'bulk' ) ) {
                return [
                    'bulkItems' => $data->pluck( 'id' )
                ];
            }

            return [ 'data' => $data ];
        }

        return view( 'admin.leave-request.index', [ 'data' => $data ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $this->authorize( 'admin.leave-request.create' );

        return view( 'admin.leave-request.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeaveRequest $request
     *
     * @return Response|array
     */
    public function store( StoreLeaveRequest $request ) {
        // Sanitize input
        $sanitized = $request->validated();

        $sanitized[ 'user_id' ] = $request->user()->id;

        // Store the LeaveRequest
        $leaveRequest = LeaveRequest::create( $sanitized );

        broadcast_to_role( 'Manager', new \App\Notifications\Managers\LeaveRequest( $leaveRequest, $request->user() ) );

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/leave-requests' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' )
            ];
        }

        return redirect( 'admin/leave-requests' );
    }

    /**
     * Display the specified resource.
     *
     * @param LeaveRequest $leaveRequest
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, LeaveRequest $leaveRequest ) {
        $this->authorize( 'admin.leave-request.show', $leaveRequest );

        // TODO your code goes here
        if ( $request->ajax() ) {
            return new Resource( $leaveRequest );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LeaveRequest $leaveRequest
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit( Request $request, LeaveRequest $leaveRequest ) {
        $this->authorize( 'admin.leave-request.edit', $leaveRequest );

        $data = AdminListing::create( LeaveRequest::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ '' ],

            function ( $query ) use ( $request ) {
                $query->where( 'user_id', $request->user()->id );
            }
        );


        return view( 'admin.leave-request.index', [ 'data' => $data, 'active_record' => $leaveRequest ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeaveRequest $request
     * @param LeaveRequest       $leaveRequest
     *
     * @return Response|array
     */
    public function update( UpdateLeaveRequest $request, LeaveRequest $leaveRequest ) {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values LeaveRequest
        $leaveRequest->update( $sanitized );

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/leave-requests' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' ),
            ];
        }

        return redirect( 'admin/leave-requests' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyLeaveRequest $request
     * @param LeaveRequest        $leaveRequest
     *
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy( DestroyLeaveRequest $request, LeaveRequest $leaveRequest ) {
        $leaveRequest->delete();

        if ( $request->ajax() ) {
            return response( [ 'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' ) ] );
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyLeaveRequest $request
     *
     * @return  Response|bool
     * @throws  \Exception
     */
    public function bulkDestroy( DestroyLeaveRequest $request ) : Response {
        DB::transaction( function () use ( $request ) {
            collect( $request->data[ 'ids' ] )
                ->chunk( 1000 )
                ->each( function ( $bulkChunk ) {
                    LeaveRequest::whereIn( 'id', $bulkChunk )->delete();

                    // TODO your code goes here
                } );
        } );

        if ( $request->ajax() ) {
            return response( [ 'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' ) ] );
        }

        return redirect()->back();
    }

}
