<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorPaymentTermResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\VendorPaymentTerm\IndexVendorPaymentTerm;
use App\Http\Requests\Admin\VendorPaymentTerm\StoreVendorPaymentTerm;
use App\Http\Requests\Admin\VendorPaymentTerm\UpdateVendorPaymentTerm;
use App\Http\Requests\Admin\VendorPaymentTerm\DestroyVendorPaymentTerm;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\VendorPaymentTerm;

class VendorPaymentTermsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( VendorPaymentTerm::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name', 'default' ],

            // set columns to searchIn
            [ 'id', 'name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexVendorPaymentTerm $request
     * @return Response|array
     */
    public function index(IndexVendorPaymentTerm $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.vendor-payment-term.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.vendor-payment-term.create');

        return view('admin.vendor-payment-term.index', [
            'create' => true,
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVendorPaymentTerm $request
     * @return Response|array
     */
    public function store(StoreVendorPaymentTerm $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the VendorPaymentTerm
        $vendorPaymentTerm = VendorPaymentTerm::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-payment-terms'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-payment-terms');
    }

    /**
     * Display the specified resource.
     *
     * @param  VendorPaymentTerm $vendorPaymentTerm
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, VendorPaymentTerm $vendorPaymentTerm)
    {
        $this->authorize('admin.vendor-payment-term.show', $vendorPaymentTerm);

        if ( $request->ajax() ) {
            return new VendorPaymentTermResource( $vendorPaymentTerm );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  VendorPaymentTerm $vendorPaymentTerm
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(VendorPaymentTerm $vendorPaymentTerm)
    {
        $this->authorize('admin.vendor-payment-term.edit', $vendorPaymentTerm);

        return view('admin.vendor-payment-term.index', [
            'active_record' => ( new VendorPaymentTermResource( $vendorPaymentTerm ) )->toArray( request() ),
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVendorPaymentTerm $request
     * @param  VendorPaymentTerm $vendorPaymentTerm
     * @return Response|array
     */
    public function update(UpdateVendorPaymentTerm $request, VendorPaymentTerm $vendorPaymentTerm)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values VendorPaymentTerm
        $vendorPaymentTerm->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendor-payment-terms'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendor-payment-terms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyVendorPaymentTerm $request
     * @param  VendorPaymentTerm $vendorPaymentTerm
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyVendorPaymentTerm $request, VendorPaymentTerm $vendorPaymentTerm)
    {
        $vendorPaymentTerm->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
