<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Timesheet\IndexTimesheet;
use App\Http\Requests\Admin\Timesheet\StoreTimesheet;
use App\Http\Requests\Admin\Timesheet\UpdateTimesheet;
use App\Http\Requests\Admin\Timesheet\DestroyTimesheet;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;

class TimesheetsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexTimesheet $request
     * @return Response|array
     */
    public function index(IndexTimesheet $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Timesheet::class)->processRequestAndGet(
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

        return view('admin.timesheet.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.timesheet.create');

        return view('admin.timesheet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTimesheet $request
     * @return Response|array
     */
    public function store(StoreTimesheet $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Timesheet
        $timesheet = Timesheet::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/timesheets'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/timesheets');
    }

    /**
     * Display the specified resource.
     *
     * @param  Timesheet $timesheet
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Timesheet $timesheet)
    {
        $this->authorize('admin.timesheet.show', $timesheet);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Timesheet $timesheet
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Timesheet $timesheet)
    {
        $this->authorize('admin.timesheet.edit', $timesheet);


        return view('admin.timesheet.edit', [
            'timesheet' => $timesheet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTimesheet $request
     * @param  Timesheet $timesheet
     * @return Response|array
     */
    public function update(UpdateTimesheet $request, Timesheet $timesheet)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Timesheet
        $timesheet->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/timesheets'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/timesheets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyTimesheet $request
     * @param  Timesheet $timesheet
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyTimesheet $request, Timesheet $timesheet)
    {
        $timesheet->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyTimesheet $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyTimesheet $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Timesheet::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
