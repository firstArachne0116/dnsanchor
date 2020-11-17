<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\DestroyContact;
use App\Http\Requests\Admin\Contact\IndexContact;
use App\Http\Requests\Admin\Contact\StoreContact;
use App\Http\Requests\Admin\Contact\UpdateContact;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Response;

class ContactsController extends Controller {

    public function getListing($request) {
        return AdminListing::create( Contact::class )->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            [ '*' ],

            // set columns to searchIn
            [ 'id', 'type', 'company_name', 'primary_contact_name', 'primary_contact_status', 'source' ]
        );
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
        $data = $this->getListing( $request );

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
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' )
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
                'message'  => trans( 'brackets/admin-ui::admin.operation.succeeded' )
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
