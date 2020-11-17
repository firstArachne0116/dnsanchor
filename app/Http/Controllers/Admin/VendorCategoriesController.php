<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\VendorCategory\IndexVendorCategory;
use App\Http\Requests\Admin\VendorCategory\StoreVendorCategory;
use App\Http\Requests\Admin\VendorCategory\UpdateVendorCategory;
use App\Http\Requests\Admin\VendorCategory\DestroyVendorCategory;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\VendorCategory;

class VendorCategoriesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( VendorCategory::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name' ],

            // set columns to searchIn
            [ 'name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexVendorCategory $request
     * @return Response|array
     */
    public function index(IndexVendorCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.vendor-category.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.vendor-category.create');

        return view('admin.vendor-category.index', [
            'create' => true,
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVendorCategory $request
     * @return Response|array
     */
    public function store(StoreVendorCategory $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the VendorCategory
        $vendorCategory = VendorCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  VendorCategory $vendorCategory
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, VendorCategory $vendorCategory)
    {
        $this->authorize('admin.vendor-category.show', $vendorCategory);

        if ( $request->ajax() ) {
            return new VendorCategoryResource( $vendorCategory );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  VendorCategory $vendorCategory
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(VendorCategory $vendorCategory)
    {
        $this->authorize('admin.vendor-category.edit', $vendorCategory);

        return view('admin.vendor-category.index', [
            'active_record' => ( new VendorCategoryResource( $vendorCategory ) )->toArray(request()),
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVendorCategory $request
     * @param  VendorCategory $vendorCategory
     * @return Response|array
     */
    public function update(UpdateVendorCategory $request, VendorCategory $vendorCategory)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values VendorCategory
        $vendorCategory->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyVendorCategory $request
     * @param  VendorCategory $vendorCategory
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyVendorCategory $request, VendorCategory $vendorCategory)
    {
        $vendorCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
