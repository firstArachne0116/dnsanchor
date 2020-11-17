<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrientationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Orientation\IndexOrientation;
use App\Http\Requests\Admin\Orientation\StoreOrientation;
use App\Http\Requests\Admin\Orientation\UpdateOrientation;
use App\Http\Requests\Admin\Orientation\DestroyOrientation;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Orientation;

class OrientationsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( Orientation::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name' ],

            // set columns to searchIn
            [ 'id', 'name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexOrientation $request
     * @return Response|array
     */
    public function index(IndexOrientation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.orientation.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.orientation.create');

        return view('admin.orientation.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrientation $request
     * @return Response|array
     */
    public function store(StoreOrientation $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Orientation
        $orientation = Orientation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/orientations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orientations');
    }

    /**
     * Display the specified resource.
     *
     * @param  Orientation $orientation
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, Orientation $orientation)
    {
        $this->authorize('admin.orientation.show', $orientation);

        if ( $request->ajax() ) {
            return new OrientationResource( $orientation );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Orientation $orientation
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Orientation $orientation)
    {
        $this->authorize('admin.orientation.edit', $orientation);

        return view('admin.orientation.index', [
            'active_record' => $orientation,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrientation $request
     * @param  Orientation $orientation
     * @return Response|array
     */
    public function update(UpdateOrientation $request, Orientation $orientation)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Orientation
        $orientation->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/orientations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orientations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyOrientation $request
     * @param  Orientation $orientation
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyOrientation $request, Orientation $orientation)
    {
        $orientation->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
