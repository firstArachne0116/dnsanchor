<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorNoteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\VendorNote\IndexVendorNote;
use App\Http\Requests\Admin\VendorNote\StoreVendorNote;
use App\Http\Requests\Admin\VendorNote\UpdateVendorNote;
use App\Http\Requests\Admin\VendorNote\DestroyVendorNote;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\VendorNote;

class VendorNotesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( VendorNote::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name', 'note', 'default' ],

            // set columns to searchIn
            [ 'id', 'name', 'note' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexVendorNote $request
     * @return Response|array
     */
    public function index(IndexVendorNote $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.vendor-note.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.vendor-note.create');

        return view('admin.vendor-note.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVendorNote $request
     * @return Response|array
     */
    public function store(StoreVendorNote $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the VendorNote
        $vendorNote = VendorNote::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-notes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  VendorNote $vendorNote
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, VendorNote $vendorNote)
    {
        $this->authorize('admin.vendor-note.show', $vendorNote);

        if ( $request->ajax() ) {
            return new VendorNoteResource( $vendorNote );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  VendorNote $vendorNote
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(VendorNote $vendorNote)
    {
        $this->authorize('admin.vendor-note.edit', $vendorNote);

        return view('admin.vendor-note.index', [
            'active_record' => ( new VendorNoteResource( $vendorNote ) )->toArray( request() ),
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVendorNote $request
     * @param  VendorNote $vendorNote
     * @return Response|array
     */
    public function update(UpdateVendorNote $request, VendorNote $vendorNote)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values VendorNote
        $vendorNote->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-notes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-notes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyVendorNote $request
     * @param  VendorNote $vendorNote
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyVendorNote $request, VendorNote $vendorNote)
    {
        $vendorNote->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
