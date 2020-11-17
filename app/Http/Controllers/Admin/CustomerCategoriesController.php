<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\CustomerCategory\IndexCustomerCategory;
use App\Http\Requests\Admin\CustomerCategory\StoreCustomerCategory;
use App\Http\Requests\Admin\CustomerCategory\UpdateCustomerCategory;
use App\Http\Requests\Admin\CustomerCategory\DestroyCustomerCategory;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\CustomerCategory;

class CustomerCategoriesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( CustomerCategory::class )->processRequestAndGet(
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
     * @param  IndexCustomerCategory $request
     * @return Response|array
     */
    public function index(IndexCustomerCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.customer-category.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.customer-category.create');

        return view('admin.customer-category.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerCategory $request
     * @return Response|array
     */
    public function store(StoreCustomerCategory $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the CustomerCategory
        $customerCategory = CustomerCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customer-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customer-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  CustomerCategory $customerCategory
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, CustomerCategory $customerCategory)
    {
        $this->authorize('admin.customer-category.show', $customerCategory);

        if ( $request->ajax() ) {
            return new CustomerCategoryResource( $customerCategory );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CustomerCategory $customerCategory
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(CustomerCategory $customerCategory)
    {
        $this->authorize('admin.customer-category.edit', $customerCategory);

        return view('admin.customer-category.index', [
            'active_record' => $customerCategory,
            'data' => $this->getListing(request()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerCategory $request
     * @param  CustomerCategory $customerCategory
     * @return Response|array
     */
    public function update(UpdateCustomerCategory $request, CustomerCategory $customerCategory)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values CustomerCategory
        $customerCategory->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customer-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customer-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCustomerCategory $request
     * @param  CustomerCategory $customerCategory
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyCustomerCategory $request, CustomerCategory $customerCategory)
    {
        $customerCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
