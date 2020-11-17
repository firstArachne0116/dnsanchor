<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccessLog\DestroyAccessLog;
use App\Http\Requests\Admin\AccessLog\IndexAccessLog;
use App\Http\Requests\Admin\AccessLog\StoreAccessLog;
use App\Http\Requests\Admin\AccessLog\UpdateAccessLog;
use App\Http\Resources\AccessLogResource;
use App\Models\AccessLog;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessLogsController extends Controller {

    public function getListing( $request ) {
        return AdminListing::create( AccessLog::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'status', 'url', 'username', 'ip_address', 'user_agent', 'created_at' ],

            // set columns to searchIn
            [ 'status', 'url', 'username', 'ip_address', 'user_agent' ],

            function ( $query ) {
                $query->orderByDesc( 'id' );
            }
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexAccessLog $request
     *
     * @return Response|array
     */
    public function index( IndexAccessLog $request ) {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        if ( $request->ajax() ) {
            return [ 'data' => $data ];
        }

        return view( 'admin.access-log.index', [ 'data' => $data ] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create( \Illuminate\Http\Request $request ) {
        $this->authorize( 'admin.access-log.create' );

        return view( 'admin.access-log.index', [
            'create' => true,
            'data' => $this->getListing( $request )
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccessLog $request
     *
     * @return Response|array
     */
    public function store( StoreAccessLog $request ) {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the AccessLog
        $accessLog = AccessLog::create( $sanitized );

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/access-logs' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' )
            ];
        }

        return redirect( 'admin/access-logs' );
    }

    /**
     * Display the specified resource.
     *
     * @param AccessLog $accessLog
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( \Illuminate\Http\Request $request, AccessLog $accessLog ) {
        $this->authorize( 'admin.access-log.show', $accessLog );

        if ( $request->ajax() ) {
            return new AccessLogResource( $accessLog );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AccessLog $accessLog
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit( Request $request, AccessLog $accessLog ) {
        $this->authorize( 'admin.access-log.edit', $accessLog );

        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        return view( 'admin.access-log.index', [
            'active_record' => $accessLog,
            'data' => $data,
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAccessLog $request
     * @param AccessLog       $accessLog
     *
     * @return Response|array
     */
    public function update( UpdateAccessLog $request, AccessLog $accessLog ) {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values AccessLog
        $accessLog->update( $sanitized );

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/access-logs' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' )
            ];
        }

        return redirect( 'admin/access-logs' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAccessLog $request
     * @param AccessLog        $accessLog
     *
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy( DestroyAccessLog $request, AccessLog $accessLog ) {
        $accessLog->delete();

        if ( $request->ajax() ) {
            return response( [ 'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' ) ] );
        }

        return redirect()->back();
    }

}
