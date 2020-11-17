<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RemittanceInformationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\RemittanceInfo\IndexRemittanceInfo;
use App\Http\Requests\Admin\RemittanceInfo\StoreRemittanceInfo;
use App\Http\Requests\Admin\RemittanceInfo\UpdateRemittanceInfo;
use App\Http\Requests\Admin\RemittanceInfo\DestroyRemittanceInfo;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\RemittanceInfo;

class RemittanceInfoController extends Controller
{
    public function getListing($request) {
        return AdminListing::create( RemittanceInfo::class )->processRequestAndGet(
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
     * @param  IndexRemittanceInfo $request
     * @return Response|array
     */
    public function index(IndexRemittanceInfo $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.remittance-info.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.remittance-info.create');

        return view('admin.remittance-info.index', [
            'create' => true,
            'data' => $this->getListing(request()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRemittanceInfo $request
     * @return Response|array
     */
    public function store(StoreRemittanceInfo $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the RemittanceInfo
        $remittanceInfo = RemittanceInfo::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/remittance-infos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/remittance-infos');
    }

    /**
     * Display the specified resource.
     *
     * @param  RemittanceInfo $remittanceInfo
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, RemittanceInfo $remittanceInfo)
    {
        $this->authorize('admin.remittance-info.show', $remittanceInfo);

        if ( $request->ajax( ) ) {
            return new RemittanceInformationResource( $remittanceInfo );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RemittanceInfo $remittanceInfo
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(RemittanceInfo $remittanceInfo)
    {
        $this->authorize('admin.remittance-info.edit', $remittanceInfo);

        return view('admin.remittance-info.index', [
            'active_record' => ( new RemittanceInformationResource( $remittanceInfo ) )->toArray( request() ),
            'data' => $this->getListing( request() ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRemittanceInfo $request
     * @param  RemittanceInfo $remittanceInfo
     * @return Response|array
     */
    public function update(UpdateRemittanceInfo $request, RemittanceInfo $remittanceInfo)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values RemittanceInfo
        $remittanceInfo->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/remittance-infos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/remittance-infos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyRemittanceInfo $request
     * @param  RemittanceInfo $remittanceInfo
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyRemittanceInfo $request, RemittanceInfo $remittanceInfo)
    {
        $remittanceInfo->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
