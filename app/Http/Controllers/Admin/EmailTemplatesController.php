<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmailTemplateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\EmailTemplate\IndexEmailTemplate;
use App\Http\Requests\Admin\EmailTemplate\StoreEmailTemplate;
use App\Http\Requests\Admin\EmailTemplate\UpdateEmailTemplate;
use App\Http\Requests\Admin\EmailTemplate\DestroyEmailTemplate;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\EmailTemplate;

class EmailTemplatesController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( EmailTemplate::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ 'id', 'name', 'published_at' ],

            // set columns to searchIn
            [ 'id', 'name', 'header', 'body', 'footer' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexEmailTemplate $request
     * @return Response|array
     */
    public function index(IndexEmailTemplate $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.email-template.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.email-template.index');

        return view('admin.email-template.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmailTemplate $request
     * @return Response|array
     */
    public function store(StoreEmailTemplate $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the EmailTemplate
        $emailTemplate = EmailTemplate::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/email-templates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/email-templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  EmailTemplate $emailTemplate
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, EmailTemplate $emailTemplate)
    {
        $this->authorize('admin.email-template.show', $emailTemplate);

        if ( $request->ajax() ) {
            return new EmailTemplateResource( $emailTemplate );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EmailTemplate $emailTemplate
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        $this->authorize('admin.email-template.edit', $emailTemplate);

        return view('admin.email-template.index', [
            'active_record' => new EmailTemplateResource( $emailTemplate ),
            'data' => $this->getListing( request() )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmailTemplate $request
     * @param  EmailTemplate $emailTemplate
     * @return Response|array
     */
    public function update(UpdateEmailTemplate $request, EmailTemplate $emailTemplate)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values EmailTemplate
        $emailTemplate->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/email-templates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/email-templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyEmailTemplate $request
     * @param  EmailTemplate $emailTemplate
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyEmailTemplate $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
