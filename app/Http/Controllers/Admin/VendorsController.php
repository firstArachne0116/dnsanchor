<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Vendor\IndexVendor;
use App\Http\Requests\Admin\Vendor\StoreVendor;
use App\Http\Requests\Admin\Vendor\UpdateVendor;
use App\Http\Requests\Admin\Vendor\DestroyVendor;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Vendor;

class VendorsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( Vendor::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'name', 'id' ],

            // set columns to searchIn
            [ 'name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexVendor $request
     * @return Response|array
     */
    public function index(IndexVendor $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.vendor.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.vendor.create');

        return view('admin.vendor.index', [
            'create' => true,
            'data' => $this->getListing(request() ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVendor $request
     * @return Response|array
     */
    public function store(StoreVendor $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }

        if ( isset( $sanitized[ 'category' ] ) ) {
            $category = $sanitized[ 'category' ];
            unset( $sanitized[ 'category' ] ); // unset

            if ( is_array( $category ) && isset( $category[ 'id' ] ) ) {
                $sanitized[ 'category_id' ] = (int) $category[ 'id' ];
            }
        }

        // Store the Vendor
        $vendor = Vendor::create($sanitized);

        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) && (int) $item[ 'ID' ] ) {
                    return (int) $item[ 'ID' ];
                }

                if ( isset( $item[ 'id' ] ) && (int) $item[ 'id' ] ) {
                    return (int) $item[ 'id' ];
                }
            }, $assigned_salespeople );

            $vendor->sales_persons()->sync( $ids );
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendors'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendors');
    }

    /**
     * Display the specified resource.
     *
     * @param  Vendor $vendor
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Vendor $vendor)
    {
        $this->authorize('admin.vendor.show', $vendor);

        if ( $request->ajax() ) {
            return new VendorResource( $vendor );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vendor $vendor
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Vendor $vendor)
    {
        $this->authorize('admin.vendor.edit', $vendor);

        return view('admin.vendor.index', [
            'data' => $this->getListing(request()),
            'active_record' => ( new VendorResource( $vendor ) )->toArray( request() ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVendor $request
     * @param  Vendor $vendor
     * @return Response|array
     */
    public function update(UpdateVendor $request, Vendor $vendor)
    {
        // Sanitize input
        $sanitized = $request->validated();

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }

        if ( isset( $sanitized[ 'category' ] ) ) {
            $category = $sanitized[ 'category' ];
            unset( $sanitized[ 'category' ] ); // unset

            if ( is_array( $category ) && isset( $category[ 'id' ] ) ) {
                $sanitized[ 'category_id' ] = (int) $category[ 'id' ];
            }
        }

        // Update changed values Vendor
        $vendor->update($sanitized);

        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) && (int) $item['ID']) {
                    return (int) $item[ 'ID' ];
                }

                if ( isset( $item[ 'id' ] ) && (int) $item['id'] ) {
                    return (int) $item['id'];
                }
            }, $assigned_salespeople );

            $vendor->sales_persons()->sync( $ids );
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendors'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyVendor $request
     * @param  Vendor $vendor
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyVendor $request, Vendor $vendor)
    {
        $vendor->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
