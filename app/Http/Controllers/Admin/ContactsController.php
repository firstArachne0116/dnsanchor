<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\DestroyContact;
use App\Http\Requests\Admin\Contact\IndexContact;
use App\Http\Requests\Admin\Contact\StoreContact;
use App\Http\Requests\Admin\Contact\UpdateContact;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Project;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Response;

class ContactsController extends Controller {

    public function getListing($request) {
        $searchIn = [ 'id', 'type', 'company_name', 'primary_contact_name', 'primary_contact_status', 'primary_contact_communication_preferences', 'source' ];
        if ($request->input('0')) {
            $searchItem = json_decode($request->input('0'));
            $searchIn = [$searchItem->value];
            // echo(json_encode($searchIn));
        }
        return AdminListing::create( Contact::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            $searchIn
        );
    }

    public function filter($request) {
        $searchIn = [ 'id', 'type', 'company_name', 'primary_contact_name', 'primary_contact_status', 'primary_contact_communication_preferences', 'source' ];
        $searchItem = '';
        $contact_ids = [];
        if ($request->input('0')) {
            $searchItem = json_decode($request->input('0'));
            $searchIn = [$searchItem->value];
        }
        if (strpos($searchItem->name, 'Project') !== false) {
            $projects = Project::whereNull('deleted_at')->whereNull('approved_at');
            // if ($request->input('search')) {
                $projects = $projects->where($searchItem->value, 'like', '%'.$request->input('search').'%');
            // }
            $ids = $projects->select('client_id')->get()->toArray();
            foreach($ids as $id) {
                $contact_ids[] = $id['client_id'];
            }
        }
        else if (count($searchIn) != 0) {
            $searchText = $request->input('search');
            $contacts = Contact::select('id');

            foreach($searchIn as $item) {
                $contacts = $contacts->orWhere($item, 'like', '%'.$searchText.'%');
            }
            $ids = $contacts->get()->toArray();
            foreach($ids as $id) {
                $contact_ids[] = $id['id'];
            }
        }
        return $contact_ids;
    }

    public function stageFilter($request) {
        $stage = json_decode($request->input('1'))->value;
        $query = '%"label":"'.$stage.'","checked":true%';

        $projects = Project::whereNull('deleted_at')->whereNull('approved_at');
        $projects = $projects->where('project_stage_checklist', 'like', $query);

        $ids = $projects->select('client_id')->get()->toArray();
        $contact_ids = [];
        foreach($ids as $id) {
            $contact_ids[] = $id['client_id'];
        }
        return $contact_ids;
    }

    public function getListing1($request) {
        $contacts = Contact::select('id');
        if ($request->input('search')) {
            if ($request->input('2') && $request->input('2') == 'true')
                $contacts = $contacts->whereNotIn('id', $this->filter($request));
            else
                $contacts = $contacts->whereIn('id', $this->filter($request));
        }
        if ($request->input('1')) {
            if ($request->input('2') && $request->input('2') == 'true')
                $contacts = $contacts->whereNotIn('id', $this->stageFilter($request));
            else
                $contacts = $contacts->whereIn('id', $this->stageFilter($request));
        }
        $ids = $contacts->get()->toArray();

        $contact_ids = [];
        foreach($ids as $id) {
            $contact_ids[] = $id['id'];
        }

        $count = count($contact_ids);

        $per_page = max(intval($request->input('per_page')), 10);
        $page = max(intval($request->input('page')), 1);
        $orderBy = $request->input('orderBy', 'id');
        $orderDirection = $request->input('orderDirection', 'asc');
        $url = $request->url();

        $contacts = Contact::whereIn('id', $contact_ids)->orderBy($orderBy, $orderDirection)->offset($per_page * ($page - 1))->limit($per_page)->get()->toArray();

        $last_page = max(1, ceil($count * 1.0 / $per_page));
        $from = null;
        $to = null;

        if (count($contacts)) {
            $from = ($page - 1) * $per_page + 1;
            $to = $from - 1 + count($contacts);
        }

        return [
            "current_page" => $page,
            "data" => $contacts,
            "first_page_url" => $url."?page=1",
            "from" => $from,
            "last_page" => $last_page,
            "last_page_url" => $url."?page=".$last_page,
            "next_page_url" => ($page === $last_page) ? null : $url."?page=".($page + 1),
            "path" => $url,
            "per_page" => $per_page,
            "prev_page_url" => ($page === 1) ? null : $url."?page=".($page - 1),
            "to" => $to,
            "total" => $count
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @param IndexContact $request
     *
     * @return Response|array
     */
    public function index( IndexContact $request ) {
        // create and AdminListing instance for a specific model and
        $data = $this->getListing1( $request );

        if ( $request->ajax() ) {
            return [ 'data' => $data ];
        }

        return view( 'admin.contact.index', [ 'data' => $data ] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $this->authorize( 'admin.contact.create' );

        return view( 'admin.contact.index', [
            'create' => true,
            'data' => $this->getListing( request() ),
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContact $request
     *
     * @return Response|array
     */
    public function store( StoreContact $request ) {
        // Sanitize input
        $sanitized = $request->validated();

        if ( isset( $sanitized[ 'type' ] ) ) {
            $type_object = $sanitized[ 'type' ];
            $sanitized[ 'type' ] = $type_object[ 'value' ];
        }

        if ( isset( $sanitized[ 'source' ] ) && $sanitized[ 'source' ] ) {
            $type_object = $sanitized[ 'source' ];
            $sanitized[ 'source' ] = $type_object[ 'value' ];
        }

        if ( is_array( $sanitized['source'] ) ) {
            $sanitized[ 'source' ] = '';
        }

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset
        }

        // Store the Contact
        $contact = Contact::create( $sanitized );

        if ( isset( $assigned_salespeople ) ) {
            $ids = array_map( function ( $item ) {
                if ( isset( $item[ 'ID' ] ) ) {
                    return $item[ 'ID' ];
                }
            }, $assigned_salespeople );

            $contact->sales_persons()->sync( $ids );
        }

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/contacts' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' ),
                'id'       => $contact->id,
            ];
        }

        return redirect( 'admin/contacts' );
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show( Contact $contact ) {
        $this->authorize( 'admin.contact.show', $contact );

        if ( request()->ajax() ) {
            return new ContactResource( $contact );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit( Contact $contact ) {
        $this->authorize( 'admin.contact.edit', $contact );

        return view( 'admin.contact.index', [
            'active_record' => $contact,
            'data' => $this->getListing( request() ),
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContact $request
     * @param Contact       $contact
     *
     * @return Response|array
     */
    public function update( UpdateContact $request, Contact $contact ) {
        // Sanitize input
        $sanitized = $request->validated();

        if ( isset( $sanitized[ 'type' ] ) ) {
            $type_object         = $sanitized[ 'type' ];
            $sanitized[ 'type' ] = $type_object[ 'value' ];
        }

        if ( isset( $sanitized[ 'source' ] ) ) {
            $type_object           = $sanitized[ 'source' ];
            $sanitized[ 'source' ] = $type_object[ 'value' ];
        }

        if ( isset( $sanitized[ 'assigned_salesperson' ] ) ) {
            $assigned_salespeople = $sanitized[ 'assigned_salesperson' ];
            unset( $sanitized[ 'assigned_salesperson' ] ); // unset

            $ids = array_map( function( $item ) {
                if ( isset( $item[ 'ID' ] ) ) {
                    return $item[ 'ID' ];
                }
            }, $assigned_salespeople );

            $contact->sales_persons()->sync( $ids );
        }

        // Update changed values Contact
        $contact->update( $sanitized );

        if ( $request->ajax() ) {
            return [
                'redirect' => url( 'admin/contacts' ),
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' ),
                'id'       => $contact->id,
            ];
        }

        return redirect( 'admin/contacts' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyContact $request
     * @param Contact        $contact
     *
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy( DestroyContact $request, Contact $contact ) {
        $contact->delete();

        if ( $request->ajax() ) {
            return response( [ 'message' => trans( 'brackets/admin-ui::admin.operation.succeeded' ) ] );
        }

        return redirect()->back();
    }

}
