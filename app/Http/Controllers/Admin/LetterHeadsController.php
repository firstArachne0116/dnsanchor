<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\LetterHeadResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\LetterHead\IndexLetterHead;
use App\Http\Requests\Admin\LetterHead\StoreLetterHead;
use App\Http\Requests\Admin\LetterHead\UpdateLetterHead;
use App\Http\Requests\Admin\LetterHead\DestroyLetterHead;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\LetterHead;

class LetterHeadsController extends Controller
{

    public function getListing($request) {
        return AdminListing::create( LetterHead::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ 'id', 'name' ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  IndexLetterHead $request
     * @return Response|array
     */
    public function index(IndexLetterHead $request)
    {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing($request);

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.letter-head.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.letter-head.create');

        return view('admin.letter-head.index', [
            'create' => true,
            'data' => $this->getListing(request())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLetterHead $request
     * @return Response|array
     */
    public function store(StoreLetterHead $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the LetterHead
        $letterHead = LetterHead::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/letter-heads'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/letter-heads');
    }

    /**
     * Display the specified resource.
     *
     * @param  LetterHead $letterHead
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Request $request, LetterHead $letterHead)
    {
        $this->authorize('admin.letter-head.show', $letterHead);

        if ( $request->ajax() ) {
            return new LetterHeadResource( $letterHead );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LetterHead $letterHead
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(LetterHead $letterHead)
    {
        $this->authorize('admin.letter-head.edit', $letterHead);

        return view('admin.letter-head.index', [
            'active_record' => $letterHead,
            'data' => $this->getListing(request()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLetterHead $request
     * @param  LetterHead $letterHead
     * @return Response|array
     */
    public function update(UpdateLetterHead $request, LetterHead $letterHead)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values LetterHead
        $letterHead->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/letter-heads'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/letter-heads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyLetterHead $request
     * @param  LetterHead $letterHead
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyLetterHead $request, LetterHead $letterHead)
    {
        $letterHead->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
