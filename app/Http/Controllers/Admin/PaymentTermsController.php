<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTermResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\PaymentTerm\IndexPaymentTerm;
use App\Http\Requests\Admin\PaymentTerm\StorePaymentTerm;
use App\Http\Requests\Admin\PaymentTerm\UpdatePaymentTerm;
use App\Http\Requests\Admin\PaymentTerm\DestroyPaymentTerm;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\PaymentTerm;

class PaymentTermsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( PaymentTerm::class )->processRequestAndGet(
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
     * @param  IndexPaymentTerm $request
     * @return Response|array
     */
    public function index(IndexPaymentTerm $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.payment-term.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.payment-term.create');

        return view('admin.payment-term.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentTerm $request
     * @return Response|array
     */
    public function store(StorePaymentTerm $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the PaymentTerm
        $paymentTerm = PaymentTerm::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/payment-terms'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/payment-terms');
    }

    /**
     * Display the specified resource.
     *
     * @param  PaymentTerm $paymentTerm
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, PaymentTerm $paymentTerm)
    {
        $this->authorize('admin.payment-term.show', $paymentTerm);

        if ( $request->ajax() ) {
            return new PaymentTermResource( $paymentTerm );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PaymentTerm $paymentTerm
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(PaymentTerm $paymentTerm)
    {
        $this->authorize('admin.payment-term.edit', $paymentTerm);

        return view('admin.payment-term.index', [
            'active_record' => $paymentTerm,
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentTerm $request
     * @param  PaymentTerm $paymentTerm
     * @return Response|array
     */
    public function update(UpdatePaymentTerm $request, PaymentTerm $paymentTerm)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values PaymentTerm
        $paymentTerm->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/payment-terms'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/payment-terms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPaymentTerm $request
     * @param  PaymentTerm $paymentTerm
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyPaymentTerm $request, PaymentTerm $paymentTerm)
    {
        $paymentTerm->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
