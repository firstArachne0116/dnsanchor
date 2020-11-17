<?php namespace App\Http\Controllers\Admin;

use App\Models\PurchaseOrder;
use function App\Helpers\get_invoice_line_items;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\PurchaseOrderInvoiceLine\IndexPurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\PurchaseOrderInvoiceLine\StorePurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\PurchaseOrderInvoiceLine\UpdatePurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\PurchaseOrderInvoiceLine\DestroyPurchaseOrderInvoiceLine;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\PurchaseOrderInvoiceLine;
use function App\Helpers\get_purchase_order_line_items;

class PurchaseOrderInvoiceLinesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPurchaseOrderInvoiceLine $request
     * @return Response|array
     */
    public function index(IndexPurchaseOrderInvoiceLine $request, $purchase_order_id )
    {
        $purchase_order = PurchaseOrder::findOrFail( $purchase_order_id );

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PurchaseOrderInvoiceLine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['*'],

            // set columns to searchIn
            ['id'],

            function( $query ) use ( $request, $purchase_order ) {
                get_purchase_order_line_items( $purchase_order, $query, [
                    'category' => $request->has( 'category' ) ? $request->input( 'category' ) : null,
                ] );
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.purchase-order-invoice-line.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.purchase-order-invoice-line.create');

        return view('admin.purchase-order-invoice-line.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePurchaseOrderInvoiceLine $request
     * @return Response|array
     */
    public function store($purchase_order_id, StorePurchaseOrderInvoiceLine $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        if ( ! isset( $sanitized[ 'purchase_order_id' ] ) ) {
            $sanitized[ 'purchase_order_id' ] = $purchase_order_id;
        }

        // Store the PurchaseOrderInvoiceLine
        $PurchaseOrderInvoiceLine = PurchaseOrderInvoiceLine::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/purchase-order-invoice-lines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/purchase-order-invoice-lines');
    }

    /**
     * Display the specified resource.
     *
     * @param  PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine)
    {
        $this->authorize('admin.purchase-order-invoice-line.show', $PurchaseOrderInvoiceLine);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine)
    {
        $this->authorize('admin.purchase-order-invoice-line.edit', $PurchaseOrderInvoiceLine);

        return view('admin.purchase-order-invoice-line.edit', [
            'PurchaseOrderInvoiceLine' => $PurchaseOrderInvoiceLine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePurchaseOrderInvoiceLine $request
     * @param  PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine
     * @return Response|array
     */
    public function update(UpdatePurchaseOrderInvoiceLine $request, PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values PurchaseOrderInvoiceLine
        $PurchaseOrderInvoiceLine->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/purchase-order-invoice-lines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/purchase-order-invoice-lines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPurchaseOrderInvoiceLine $request
     * @param  PurchaseOrderInvoiceLine $PurchaseOrderInvoiceLine
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyPurchaseOrderInvoiceLine $request, Project $purchase_order, $PurchaseOrderInvoiceLineID)
    {
        $PurchaseOrderInvoiceLine = PurchaseOrderInvoiceLine::findOrFail( $PurchaseOrderInvoiceLineID );
        $PurchaseOrderInvoiceLine->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
