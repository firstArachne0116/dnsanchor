<?php namespace App\Http\Controllers\Admin;

use function App\Helpers\get_invoice_line_items;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\ProjectInvoiceLine\IndexPurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\ProjectInvoiceLine\StorePurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\ProjectInvoiceLine\UpdatePurchaseOrderInvoiceLine;
use App\Http\Requests\Admin\ProjectInvoiceLine\DestroyPurchaseOrderInvoiceLine;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\ProjectInvoiceLine;

class ProjectInvoiceLinesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPurchaseOrderInvoiceLine $request
     *
     * @return Response|array
     */
    public function index( IndexPurchaseOrderInvoiceLine $request, $project_id )
    {
        $project = Project::findOrFail( $project_id );
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ProjectInvoiceLine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['*'],

            // set columns to searchIn
            ['id'],

            function( $query ) use ( $request, $project ) {
                get_invoice_line_items( $project, $query, [
                    'category' => $request->has( 'category' ) ? $request->input( 'category' ) : null,
                ] );
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.project-invoice-line.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.project-invoice-line.create');

        return view('admin.project-invoice-line.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePurchaseOrderInvoiceLine $request
     *
     * @return Response|array
     */
    public function store($project_id, StorePurchaseOrderInvoiceLine $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        if ( ! isset( $sanitized[ 'project_id' ] ) ) {
            $sanitized[ 'project_id' ] = $project_id;
        }

        // Store the ProjectInvoiceLine
        $projectInvoiceLine = ProjectInvoiceLine::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/project-invoice-lines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/project-invoice-lines');
    }

    /**
     * Display the specified resource.
     *
     * @param  ProjectInvoiceLine $projectInvoiceLine
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(ProjectInvoiceLine $projectInvoiceLine)
    {
        $this->authorize('admin.project-invoice-line.show', $projectInvoiceLine);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProjectInvoiceLine $projectInvoiceLine
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(ProjectInvoiceLine $projectInvoiceLine)
    {
        $this->authorize('admin.project-invoice-line.edit', $projectInvoiceLine);

        return view('admin.project-invoice-line.edit', [
            'projectInvoiceLine' => $projectInvoiceLine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePurchaseOrderInvoiceLine $request
     * @param  ProjectInvoiceLine             $projectInvoiceLine
     *
     * @return Response|array
     */
    public function update( $project_id, $projectInvoiceLineID, StorePurchaseOrderInvoiceLine $request )
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values ProjectInvoiceLine
        // $projectInvoiceLine->update($sanitized);
        // $projectInvoiceLine->save();

        ProjectInvoiceLine::where('id', '=', $projectInvoiceLineID)->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/project-invoice-lines'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                // 'origin' => $projectInvoiceLine->toArray(),
                'update' => $sanitized,
                'project_id' => $project_id,
            ];
        }

        return redirect('admin/project-invoice-lines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPurchaseOrderInvoiceLine $request
     * @param  ProjectInvoiceLine              $projectInvoiceLine
     *
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy( DestroyPurchaseOrderInvoiceLine $request, Project $project, $projectInvoiceLineID)
    {
        $projectInvoiceLine = ProjectInvoiceLine::findOrFail( $projectInvoiceLineID );
        $projectInvoiceLine->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
