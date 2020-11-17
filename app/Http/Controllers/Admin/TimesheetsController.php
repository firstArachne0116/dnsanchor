<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\AdminUser\IndexAdminUser;
use App\Http\Requests\Admin\Timesheet\IndexTimesheet;
use App\Http\Requests\Admin\Timesheet\StoreTimesheet;
use App\Http\Requests\Admin\Timesheet\UpdateTimesheet;
use App\Http\Requests\Admin\Timesheet\DestroyTimesheet;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Timesheet;
use Illuminate\Support\Facades\DB;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class TimesheetsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexTimesheet $request
     * @return Response|array
     */
    protected $guard = 'admin';

    public function __construct()
    {
        // TODO add authorization
        $this->guard = config('admin-auth.defaults.guard');
    }


    public function getListing($request) {
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
     * Get logged user before each method
     *
     * @param  Request $request
     */
    protected function setUser($request) {
        if (empty($request->user($this->guard))) {
            abort(404, 'Admin User not found');
        }

        $this->adminUser = $request->user($this->guard);
    }

    public function index(IndexAdminUser $request)
    {
        // create and AdminListing instance for a specific model and
        $this->setUser($request);

        $data = $this->getListing( $request );

        $today = "" . date("Y-m-d");

        $data = json_decode(json_encode($data));
        foreach($data->data as $item) {
            $item->status = false;
            $record = TimeSheet::where('user_id', '=', $item->id)->where('date', '=', $today)->first();
            if ($record && (($record->time_in_2 && !$record->time_out_2) || ($record->time_in_1 && !$record->time_out_1))) {
                $item->status = true;
            }
        }

        if ( $request->ajax() ) {
            return [ 'data' => $data, 'activation' => Config::get( 'admin-auth.activation_enabled' ) ];
        }

        return view( 'admin.timesheet.index', [
            'data'       => $data,
            'activation' => Config::get( 'admin-auth.activation_enabled' ),
            'roles' => Role::where( 'guard_name', $this->guard )->get(),
            'userId' => $this->adminUser->id
        ]);
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

    protected function getTimeSheetByUserId($userId)
    {
        $user = AdminUser::find($userId);
        $pay_from = $user->pay_from;
        $pay_to = $user->pay_to;

        if (!$pay_from || !$pay_to) {
            return ['pay_from' => $pay_from, 'pay_to' => $pay_to];
        }

        return ['pay_from' => $pay_from, 'pay_to' => $pay_to, 'timesheet' => TimeSheet::where('date', '>=', $pay_from)->where('date', '<=', $pay_to)->get()];
    }

    public function timesheet(Request $request)
    {
        $userId = $request->input('userId');
        return $this->getTimeSheetByUserId($userId);
    }

    public function setPayPeriod(Request $request)
    {
        $userId = $request->input('userId');
        $user = AdminUser::find($userId);
        $user->pay_from = $request->input('pay_from');
        $user->pay_to = $request->input('pay_to');
        $user->save();
        return $this->getTimeSheetByUserId($userId);
    }

    public function updateRecord(Request $request)
    {
        $record = null;
        if ($request->input('id')) {
            $record = TimeSheet::find($request->input('id'));
        }
        else {
            $record = new TimeSheet;
        }
        $record->time_in_1 = $request->input('time_in_1');
        $record->time_out_1 = $request->input('time_out_1');
        $record->time_in_2 = $request->input('time_in_2');
        $record->time_out_2 = $request->input('time_out_2');
        $record->regular_hrs = $request->input('regular_hrs');
        $record->holiday_hrs = $request->input('holiday_hrs');
        $record->overtime_hrs = $request->input('overtime_hrs');
        $record->sick_hrs = $request->input('sick_hrs');
        $record->vacation_hrs = $request->input('vacation_hrs');
        $record->user_id = $request->input('user_id');
        $record->date = $request->input('date');
        $record->save();
        return $record;
    }
}
