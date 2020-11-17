<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Role\IndexRole;
use App\Http\Requests\Admin\Role\StoreRole;
use App\Http\Requests\Admin\Role\UpdateRole;
use App\Http\Requests\Admin\Role\DestroyRole;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( Role::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name', 'guard_name' ],

            // set columns to searchIn
            [ 'id', 'name', 'guard_name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexRole $request
     * @return Response|array
     */
    public function index(IndexRole $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        $permissions = Permission::all();

        return view('admin.role.index', ['data' => $data, 'permissions' => $permissions]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.role.create');

        $permissions = Permission::all();

        return view('admin.role.index', [
            'permissions' => $permissions,
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRole $request
     * @return Response|array
     */
    public function store(StoreRole $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Role
        $role = Role::create($sanitized);
        $role->permissions()->sync( $sanitized[ 'permissions' ] );

        if ($request->ajax()) {
            return ['redirect' => url('admin/roles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, Role $role)
    {
        $this->authorize('admin.role.show', $role);

        if ( $request->ajax() ) {
            return new RoleResource( $role );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Role $role)
    {
        $this->authorize('admin.role.edit', $role);

        $permissions = Permission::all();

        return view('admin.role.index', [
            'active_record' => ( new RoleResource( $role ) )->toArray( request() ),
            'permissions' => $permissions,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRole $request
     * @param  Role $role
     * @return Response|array
     */
    public function update(UpdateRole $request, Role $role)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Role
        $role->update($sanitized);
        $role->permissions()->sync( $sanitized[ 'permissions' ] );

        if ($request->ajax()) {
            return ['redirect' => url('admin/roles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyRole $request
     * @param  Role $role
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyRole $request, Role $role)
    {
        $role->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
