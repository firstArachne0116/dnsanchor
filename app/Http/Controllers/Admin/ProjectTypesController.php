<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\ProjectType\IndexProjectType;
use App\Http\Requests\Admin\ProjectType\StoreProjectType;
use App\Http\Requests\Admin\ProjectType\UpdateProjectType;
use App\Http\Requests\Admin\ProjectType\DestroyProjectType;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\ProjectType;

class ProjectTypesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( ProjectType::class )->processRequestAndGet(
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
     * @param  IndexProjectType $request
     * @return Response|array
     */
    public function index(IndexProjectType $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.project-type.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.project-type.create');

        return view('admin.project-type.index', [
            'create' => true,
            'data' => $this->getListing(request() )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectType $request
     * @return Response|array
     */
    public function store(StoreProjectType $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the ProjectType
        $projectType = ProjectType::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/project-types'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/project-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  ProjectType $projectType
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, ProjectType $projectType)
    {
        $this->authorize('admin.project-type.show', $projectType);

        if ( $request->ajax() ) {
            return new ProjectTypeResource( $projectType );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProjectType $projectType
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(ProjectType $projectType)
    {
        $this->authorize('admin.project-type.edit', $projectType);

        return view('admin.project-type.index', [
            'active_record' => ( new ProjectTypeResource( $projectType ) )->toArray( request() ),
            'data' => $this->getListing( request() ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectType $request
     * @param  ProjectType $projectType
     * @return Response|array
     */
    public function update(UpdateProjectType $request, ProjectType $projectType)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values ProjectType
        $projectType->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/project-types'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/project-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyProjectType $request
     * @param  ProjectType $projectType
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyProjectType $request, ProjectType $projectType)
    {
        $projectType->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
