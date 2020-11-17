<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmailTemplateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Template\IndexTemplate;
use App\Http\Requests\Admin\Template\StoreTemplate;
use App\Http\Requests\Admin\Template\UpdateTemplate;
use App\Http\Requests\Admin\Template\DestroyTemplate;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Template;
use Illuminate\Support\Facades\DB;

class TemplatesController extends Controller
{

    public function getListing( $request ) {
        return AdminListing::create( Template::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ 'id' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexTemplate $request
     * @return Response|array
     */
    public function index(IndexTemplate $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing( $request );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.template.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.template.create');

        return view('admin.template.index', [
            'create' => true,
            'data'   => $this->getListing( request() )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTemplate $request
     * @return Response|array
     */
    public function store(StoreTemplate $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Template
        $template = Template::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/templates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  Template $template
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Template $template)
    {
        $this->authorize('admin.template.show', $template);

        if ( $request->ajax() ) {
            return new Resource( $template );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Template $template
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Template $template)
    {
        $this->authorize('admin.template.edit', $template);

        return view('admin.template.index', [
            'active_record' => new Resource( $template ),
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTemplate $request
     * @param  Template $template
     * @return Response|array
     */
    public function update(UpdateTemplate $request, Template $template)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Template
        $template->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/templates'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyTemplate $request
     * @param  Template $template
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyTemplate $request, Template $template)
    {
        $template->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyTemplate $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyTemplate $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Template::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
