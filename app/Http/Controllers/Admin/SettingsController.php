<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Setting\IndexSetting;
use App\Http\Requests\Admin\Setting\StoreSetting;
use App\Http\Requests\Admin\Setting\UpdateSetting;
use App\Http\Requests\Admin\Setting\DestroySetting;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Setting;

class SettingsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( Setting::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name', 'value' ],

            // set columns to searchIn
            [ 'name', 'value' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexSetting $request
     * @return Response|array
     */
    public function index(IndexSetting $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.setting.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.setting.create');

        return view('admin.setting.index', [
            'create' => true,
            'data' => $this->getListing(request()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSetting $request
     * @return Response|array
     */
    public function store(StoreSetting $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Setting
        $setting = Setting::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/settings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  Setting $setting
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Setting $setting)
    {
        $this->authorize('admin.setting.show', $setting);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting $setting
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Setting $setting)
    {
        $this->authorize('admin.setting.edit', $setting);

        return view('admin.setting.index', [
            'active_record' => $setting,
            'data' => $this->getListing(request()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSetting $request
     * @param  Setting $setting
     * @return Response|array
     */
    public function update(UpdateSetting $request, Setting $setting)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Setting
        $setting->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/settings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroySetting $request
     * @param  Setting $setting
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroySetting $request, Setting $setting)
    {
        $setting->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
