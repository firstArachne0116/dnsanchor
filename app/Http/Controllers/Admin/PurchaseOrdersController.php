<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\PurchaseOrder\IndexPurchaseOrder;
use App\Http\Requests\Admin\PurchaseOrder\StorePurchaseOrder;
use App\Http\Requests\Admin\PurchaseOrder\UpdatePurchaseOrder;
use App\Http\Requests\Admin\PurchaseOrder\DestroyPurchaseOrder;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\DB;

class PurchaseOrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPurchaseOrder $request
     * @return Response|array
     */
    public function index(IndexPurchaseOrder $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PurchaseOrder::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['*'],

            // set columns to searchIn
            ['id', 'type', 'template_type', 'title', 'quantity', 'trim_size', 'information_requests', 'extent', 'origination', 'finishing_information', 'packaging_information', 'vendor_notes', 'customer_shipping_to', 'additional_comments']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.purchase-order.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.purchase-order.create');

        return view('admin.purchase-order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePurchaseOrder $request
     * @return Response|array
     */
    public function store(StorePurchaseOrder $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        $sanitized[ 'status' ]  = 'DRAFT_VERSION';
        $sanitized[ 'user_id' ] = $request->user()->id;

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }


        // Store the PurchaseOrder
        $purchaseOrder = PurchaseOrder::create($sanitized);

        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) ) {
                    return $item[ 'ID' ];
                }
            }, $assigned_salespeople );

            $purchaseOrder->sales_persons()->sync( $ids );
        }

        if ( isset( $purchaseOrder[ 'types' ] ) ) {
            $types = $purchaseOrder[ 'types' ];

            unset( $purchaseOrder[ 'types' ] );

            $purchaseOrder[ 'fields' ] = json_encode( $types );
        }

        if ($request->ajax()) {
            return [ 'success' => true, 'purchase_order' => new PurchaseOrderResource( $purchaseOrder ), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/purchase-orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  PurchaseOrder $purchaseOrder
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('admin.purchase-order.show', $purchaseOrder);

        return ( new PurchaseOrderResource( $purchaseOrder ) )->toArray( request() );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PurchaseOrder $purchaseOrder
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('admin.purchase-order.edit', $purchaseOrder);


        return view('admin.purchase-order.edit', [
            'purchaseOrder' => $purchaseOrder,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePurchaseOrder $request
     * @param  PurchaseOrder $purchaseOrder
     * @return Response|array
     */
    public function update(UpdatePurchaseOrder $request, PurchaseOrder $purchaseOrder)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values PurchaseOrder
        $purchaseOrder->update($sanitized);

        if ($request->ajax()) {
            return [
                'success' => true,
                'purchase_order' => new PurchaseOrderResource( $purchaseOrder ),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/purchase-orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPurchaseOrder $request
     * @param  PurchaseOrder $purchaseOrder
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyPurchaseOrder $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyPurchaseOrder $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyPurchaseOrder $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    PurchaseOrder::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
