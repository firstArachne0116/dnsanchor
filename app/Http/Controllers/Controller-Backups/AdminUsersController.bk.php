<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\AdminUser\IndexAdminUser;
use App\Http\Requests\Admin\AdminUser\StoreAdminUser;
use App\Http\Requests\Admin\AdminUser\UpdateAdminUser;
use App\Http\Requests\Admin\AdminUser\DestroyAdminUser;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Config;
use Brackets\AdminAuth\Services\ActivationService;
use Brackets\AdminAuth\Activation\Facades\Activation;
use Spatie\Permission\Models\Role;

class bk extends Controller
{

    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * AdminUsersController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guard = config('admin-auth.defaults.guard');
    }

    public function getListing( $request ) {
        return AdminListing::create( AdminUser::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'first_name', 'last_name', 'email', 'activated', 'forbidden', 'language' ],

            // set columns to searchIn
            [ 'id', 'first_name', 'last_name', 'email', 'language' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexAdminUser $request
     * @return Response|array
     */
    public function index(IndexAdminUser $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')];
        }

        return view('admin.admin-user.index', ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create( Request $request )
    {
        $this->authorize('admin.admin-user.create');

        return view('admin.admin-user.index',[
            'activation' => Config::get( 'admin-auth.activation_enabled' ),
            'data' => $this->getListing( $request )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAdminUser $request
     * @return Response|array
     */
    public function store(StoreAdminUser $request)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Store the AdminUser
        $adminUser = AdminUser::create($sanitized);

        // But we do have a roles, so we need to attach the roles to the adminUser
        $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Display the specified resource.
     *
     * @param  AdminUser $adminUser
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(AdminUser $adminUser)
    {
        $this->authorize('admin.admin-user.show', $adminUser);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AdminUser $adminUser
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit( Request $request, AdminUser $adminUser)
    {
        $this->authorize('admin.admin-user.edit', $adminUser);

        $adminUser->load('roles');

        return view('admin.admin-user.index', [
            'data' => $this->getListing( $request ),
            'active_record' => $adminUser,
            'activation' => Config::get('admin-auth.activation_enabled'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAdminUser $request
     * @param  AdminUser $adminUser
     * @return Response|array
     */
    public function update(UpdateAdminUser $request, AdminUser $adminUser)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values AdminUser
        $adminUser->update($sanitized);

        // But we do have a roles, so we need to attach the roles to the adminUser
        if($request->input('roles')) {
            $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyAdminUser $request
     * @param  AdminUser $adminUser
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyAdminUser $request, AdminUser $adminUser)
    {
        $adminUser->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Resend activation e-mail
    *
    * @param    \Illuminate\Http\Request  $request
    * @param  ActivationService $activationService
    * @param    AdminUser $adminUser
    * @return  array|\Illuminate\Http\Response
    */
    public function resendActivationEmail(Request $request, ActivationService $activationService, AdminUser $adminUser)
    {
        if(Config::get('admin-auth.activation_enabled')) {

            $response = $activationService->handle($adminUser);
            if($response == Activation::ACTIVATION_LINK_SENT) {
                if ($request->ajax()) {
                    return ['message' => trans('brackets/admin-ui::admin.operation.succeeded')];
                }

                return redirect()->back();
            } else {
                if ($request->ajax()) {
                    abort(409, trans('brackets/admin-ui::admin.operation.failed'));
                }

                return redirect()->back();
            }
        } else {
            if ($request->ajax()) {
                abort(400, trans('brackets/admin-ui::admin.operation.not_allowed'));
            }

            return redirect()->back();
        }
    }

    }
