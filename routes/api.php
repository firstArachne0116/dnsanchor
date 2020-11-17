<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware( 'auth:api' )->get( '/notifications', function ( Request $request ) {
    $user = $request->user();

    return $user->unreadNotifications;
});

Route::get( '/sales-persons', function ( Request $request ) {
    $users = \App\Models\AdminUser::role( 'Sales' )->get();

    return \App\Http\Resources\SalesPersonResource::collection( $users )->toResponse( $request );
} );

Route::get( '/orientations', function ( Request $request ) {
    return \App\Http\Resources\OrientationResource::collection( \App\Models\Orientation::all() )->toResponse( $request );
} );

Route::get( '/vendors', function ( Request $request ) {
    return \App\Http\Resources\VendorResource::collection( \App\Models\Vendor::all() )->toResponse( $request );
} );

Route::get( '/vendor-categories', function ( Request $request ) {
    return \App\Http\Resources\VendorCategoryResource::collection( \App\Models\VendorCategory::all() )->toResponse( $request );
} );

Route::get( '/vendor-notes', function ( Request $request ) {
    return \App\Http\Resources\VendorNoteResource::collection( \App\Models\VendorNote::all() )->toResponse( $request );
} );

Route::get( '/remittance-info', function ( Request $request ) {
    return \App\Http\Resources\RemittanceInformationResource::collection( \App\Models\RemittanceInfo::all() )->toResponse( $request );
} );

Route::get( '/vendor-payment-terms', function ( Request $request ) {
    return \App\Http\Resources\VendorPaymentTermResource::collection( \App\Models\VendorPaymentTerm::all() )->toResponse( $request );
} );

Route::get( '/payment-terms', function ( Request $request ) {
    return \App\Http\Resources\PaymentTermResource::collection( \App\Models\PaymentTerm::all() )->toResponse( $request );
} );

Route::get( '/contacts', function ( Request $request ) {
    $query = \App\Models\Contact::query();

    if ( $request->has( 'q' ) ) {
        $query->where( 'id', 'LIKE', '%' . $request->input( 'q' ) . '%' );
        $query->orWhere( 'primary_contact_name', 'LIKE', '%' . $request->input( 'q' ) . '%' );
        $query->orWhere( 'company_name', 'LIKE', '%' . $request->input( 'q' ) . '%' );
    } else {
        // Apply Filters if exists...
        $filters = new \App\Filters\ContactFilter( $request, $query );
        $filters->filter();
    }

    return \App\Http\Resources\ContactResource::collection( $query->get() )->toResponse( $request );
} );

Route::patch( '/contacts/{contact}', function( \App\Http\Requests\Admin\Contact\PatchContact $request, \App\Models\Contact $contact ) {
    $validated = $request->validated();

    return response()->json([ 'success' => $contact->update( $validated ) ] );
});
