<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Task\IndexTask;
use App\Http\Requests\Admin\Task\StoreTask;
use App\Http\Requests\Admin\Task\UpdateTask;
use App\Http\Requests\Admin\Task\DestroyTask;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexTask $request
     * @return Response|array
     */
    public function index(IndexTask $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Task::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [''],

            // set columns to searchIn
            ['']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.task.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.task.create');

        return view('admin.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTask $request
     * @return Response|array
     */
    public function store(StoreTask $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Task
        $task = Task::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tasks'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  Task $task
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Task $task)
    {
        $this->authorize('admin.task.show', $task);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Task $task)
    {
        $this->authorize('admin.task.edit', $task);


        return view('admin.task.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTask $request
     * @param  Task $task
     * @return Response|array
     */
    public function update(UpdateTask $request, Task $task)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Task
        $task->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tasks'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyTask $request
     * @param  Task $task
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyTask $request, Task $task)
    {
        $task->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyTask $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyTask $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Task::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
