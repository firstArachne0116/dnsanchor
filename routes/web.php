<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function () {
    return response()->redirectTo( '/admin/' );
} );

Route::get( 'test', function () {
    $project = \App\Models\Project::findOrFail( 61 );

# enable output of HTTP headers
    $options = new ZipStream\Option\Archive();
    $options->setSendHttpHeaders( true );

# create a new zipstream object
    $zip = new ZipStream\ZipStream( sprintf( '%s-All-Files.zip', $project->title ), $options );

    foreach ( $project->media as $media ) {
        # add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
        $zip->addFileFromPath( $media->file_name, $media->getPath() );
    }

# finish the zip stream
    $zip->finish();
} );


/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin', function () {
        return view( 'admin.dashboard.index' );
    } );

    Route::get( '/admin/admin-users', 'Admin\AdminUsersController@index' );
    Route::get( '/admin/admin-users/create', 'Admin\AdminUsersController@create' );
    Route::post( '/admin/admin-users', 'Admin\AdminUsersController@store' );
    Route::get( '/admin/admin-users/{adminUser}', 'Admin\AdminUsersController@show' );
    Route::get( '/admin/admin-users/{adminUser}/edit', 'Admin\AdminUsersController@edit' )->name( 'admin/admin-users/edit' );
    Route::post( '/admin/admin-users/{adminUser}', 'Admin\AdminUsersController@update' )->name( 'admin/admin-users/update' );
    Route::delete( '/admin/admin-users/{adminUser}', 'Admin\AdminUsersController@destroy' )->name( 'admin/admin-users/destroy' );
    Route::get( '/admin/admin-users/{adminUser}/resend-activation', 'Admin\AdminUsersController@resendActivationEmail' )->name( 'admin/admin-users/resendActivationEmail' );
} );

/* Auto-generated profile routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/profile', 'Admin\ProfileController@editProfile' );
    Route::post( '/admin/profile', 'Admin\ProfileController@updateProfile' );
    Route::get( '/admin/password', 'Admin\ProfileController@editPassword' );
    Route::post( '/admin/password', 'Admin\ProfileController@updatePassword' );
    Route::post( '/admin/logout', 'Auth\LoginController@logout' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/vendors', 'Admin\VendorsController@index' );
    Route::get( '/admin/vendors/create', 'Admin\VendorsController@create' );
    Route::post( '/admin/vendors', 'Admin\VendorsController@store' );
    Route::get( '/admin/vendors/{vendor}', 'Admin\VendorsController@show' );
    Route::get( '/admin/vendors/{vendor}/edit', 'Admin\VendorsController@edit' )->name( 'admin/vendors/edit' );
    Route::post( '/admin/vendors/{vendor}', 'Admin\VendorsController@update' )->name( 'admin/vendors/update' );
    Route::delete( '/admin/vendors/{vendor}', 'Admin\VendorsController@destroy' )->name( 'admin/vendors/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/settings', 'Admin\SettingsController@index' );
    Route::get( '/admin/settings/create', 'Admin\SettingsController@create' );
    Route::post( '/admin/settings', 'Admin\SettingsController@store' );
    Route::get( '/admin/settings/{setting}/edit', 'Admin\SettingsController@edit' )->name( 'admin/settings/edit' );
    Route::post( '/admin/settings/{setting}', 'Admin\SettingsController@update' )->name( 'admin/settings/update' );
    Route::delete( '/admin/settings/{setting}', 'Admin\SettingsController@destroy' )->name( 'admin/settings/destroy' );
} );

Route::get( 'jcc', function () {
    return view( 'admin.project.jcc' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/contacts', 'Admin\ContactsController@index' );
    Route::get( '/admin/contacts/create', 'Admin\ContactsController@create' );
    Route::post( '/admin/contacts', 'Admin\ContactsController@store' );
    Route::get( '/admin/contacts/{contact}/edit', 'Admin\ContactsController@edit' )->name( 'admin/contacts/edit' );
    Route::get( '/admin/contacts/{contact}', 'Admin\ContactsController@show' );
    Route::post( '/admin/contacts/{contact}', 'Admin\ContactsController@update' )->name( 'admin/contacts/update' );
    Route::delete( '/admin/contacts/{contact}', 'Admin\ContactsController@destroy' )->name( 'admin/contacts/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/projects', 'Admin\ProjectsController@index' );
    Route::get( '/admin/projects/create', 'Admin\ProjectsController@create' );
    Route::post( '/admin/projects', 'Admin\ProjectsController@store' );
    Route::post( '/admin/projects/{project}/fcq-signed', 'Admin\ProjectsController@fcq_signed' );
    Route::get( '/admin/projects/{project}/download-files', 'Admin\ProjectsController@download_all_files' );
    Route::delete( '/admin/projects/{project}/remove-file', 'Admin\ProjectsController@remove_file' );
    Route::get( '/admin/projects/{project}', 'Admin\ProjectsController@show' );
    Route::post( '/admin/projects/{project}/confirm', 'Admin\ProjectsController@saveAsOfficial' )->name( 'admin/projects/confirm' );
    Route::get( '/admin/projects/{project}/edit', 'Admin\ProjectsController@edit' )->name( 'admin/projects/edit' );
    Route::get( '/admin/projects/{project}/purchase-orders', 'Admin\ProjectsController@purchase_orders' )->name( 'admin/projects/purchase-orders' );

    Route::post( '/admin/projects/{project}', 'Admin\ProjectsController@update' )->name( 'admin/projects/update' );
    Route::delete( '/admin/projects/{project}', 'Admin\ProjectsController@destroy' )->name( 'admin/projects/destroy' );

    Route::post( '/admin/projects/{id}/upload', 'Admin\ProjectsController@upload_files' );

} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/access-logs', 'Admin\AccessLogsController@index' );
    Route::get( '/admin/access-logs/create', 'Admin\AccessLogsController@create' );
    Route::post( '/admin/access-logs', 'Admin\AccessLogsController@store' );
    Route::get( '/admin/access-logs/{accessLog}', 'Admin\AccessLogsController@show' );
    Route::get( '/admin/access-logs/{accessLog}/edit', 'Admin\AccessLogsController@edit' )->name( 'admin/access-logs/edit' );
    Route::post( '/admin/access-logs/{accessLog}', 'Admin\AccessLogsController@update' )->name( 'admin/access-logs/update' );
    Route::delete( '/admin/access-logs/{accessLog}', 'Admin\AccessLogsController@destroy' )->name( 'admin/access-logs/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/vendor-categories', 'Admin\VendorCategoriesController@index' );
    Route::get( '/admin/vendor-categories/create', 'Admin\VendorCategoriesController@create' );
    Route::post( '/admin/vendor-categories', 'Admin\VendorCategoriesController@store' );
    Route::get( '/admin/vendor-categories/{vendorCategory}', 'Admin\VendorCategoriesController@show' );
    Route::get( '/admin/vendor-categories/{vendorCategory}/edit', 'Admin\VendorCategoriesController@edit' )->name( 'admin/vendor-categories/edit' );
    Route::post( '/admin/vendor-categories/{vendorCategory}', 'Admin\VendorCategoriesController@update' )->name( 'admin/vendor-categories/update' );
    Route::delete( '/admin/vendor-categories/{vendorCategory}', 'Admin\VendorCategoriesController@destroy' )->name( 'admin/vendor-categories/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/vendor-payment-terms', 'Admin\VendorPaymentTermsController@index' );
    Route::get( '/admin/vendor-payment-terms/create', 'Admin\VendorPaymentTermsController@create' );
    Route::post( '/admin/vendor-payment-terms', 'Admin\VendorPaymentTermsController@store' );
    Route::get( '/admin/vendor-payment-terms/{vendorPaymentTerm}', 'Admin\VendorPaymentTermsController@show' );
    Route::get( '/admin/vendor-payment-terms/{vendorPaymentTerm}/edit', 'Admin\VendorPaymentTermsController@edit' )->name( 'admin/vendor-payment-terms/edit' );
    Route::post( '/admin/vendor-payment-terms/{vendorPaymentTerm}', 'Admin\VendorPaymentTermsController@update' )->name( 'admin/vendor-payment-terms/update' );
    Route::delete( '/admin/vendor-payment-terms/{vendorPaymentTerm}', 'Admin\VendorPaymentTermsController@destroy' )->name( 'admin/vendor-payment-terms/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/roles', 'Admin\RolesController@index' );
    Route::get( '/admin/roles/create', 'Admin\RolesController@create' );
    Route::post( '/admin/roles', 'Admin\RolesController@store' );
    Route::get( '/admin/roles/{role}', 'Admin\RolesController@show' );
    Route::get( '/admin/roles/{role}/edit', 'Admin\RolesController@edit' )->name( 'admin/roles/edit' );
    Route::post( '/admin/roles/{role}', 'Admin\RolesController@update' )->name( 'admin/roles/update' );
    Route::delete( '/admin/roles/{role}', 'Admin\RolesController@destroy' )->name( 'admin/roles/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/customer-categories', 'Admin\CustomerCategoriesController@index' );
    Route::get( '/admin/customer-categories/create', 'Admin\CustomerCategoriesController@create' );
    Route::post( '/admin/customer-categories', 'Admin\CustomerCategoriesController@store' );
    Route::get( '/admin/customer-categories/{customerCategory}', 'Admin\CustomerCategoriesController@show' );
    Route::get( '/admin/customer-categories/{customerCategory}/edit', 'Admin\CustomerCategoriesController@edit' )->name( 'admin/customer-categories/edit' );
    Route::post( '/admin/customer-categories/{customerCategory}', 'Admin\CustomerCategoriesController@update' )->name( 'admin/customer-categories/update' );
    Route::delete( '/admin/customer-categories/{customerCategory}', 'Admin\CustomerCategoriesController@destroy' )->name( 'admin/customer-categories/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/orientations', 'Admin\OrientationsController@index' );
    Route::get( '/admin/orientations/create', 'Admin\OrientationsController@create' );
    Route::post( '/admin/orientations', 'Admin\OrientationsController@store' );
    Route::get( '/admin/orientations/{orientation}', 'Admin\OrientationsController@show' );
    Route::get( '/admin/orientations/{orientation}/edit', 'Admin\OrientationsController@edit' )->name( 'admin/orientations/edit' );
    Route::post( '/admin/orientations/{orientation}', 'Admin\OrientationsController@update' )->name( 'admin/orientations/update' );
    Route::delete( '/admin/orientations/{orientation}', 'Admin\OrientationsController@destroy' )->name( 'admin/orientations/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/project-types', 'Admin\ProjectTypesController@index' );
    Route::get( '/admin/project-types/create', 'Admin\ProjectTypesController@create' );
    Route::post( '/admin/project-types', 'Admin\ProjectTypesController@store' );
    Route::get( '/admin/project-types/{projectType}', 'Admin\ProjectTypesController@show' );
    Route::get( '/admin/project-types/{projectType}/edit', 'Admin\ProjectTypesController@edit' )->name( 'admin/project-types/edit' );
    Route::post( '/admin/project-types/{projectType}', 'Admin\ProjectTypesController@update' )->name( 'admin/project-types/update' );
    Route::delete( '/admin/project-types/{projectType}', 'Admin\ProjectTypesController@destroy' )->name( 'admin/project-types/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/vendor-notes', 'Admin\VendorNotesController@index' );
    Route::get( '/admin/vendor-notes/create', 'Admin\VendorNotesController@create' );
    Route::post( '/admin/vendor-notes', 'Admin\VendorNotesController@store' );
    Route::get( '/admin/vendor-notes/{vendorNote}', 'Admin\VendorNotesController@show' );
    Route::get( '/admin/vendor-notes/{vendorNote}/edit', 'Admin\VendorNotesController@edit' )->name( 'admin/vendor-notes/edit' );
    Route::post( '/admin/vendor-notes/{vendorNote}', 'Admin\VendorNotesController@update' )->name( 'admin/vendor-notes/update' );
    Route::delete( '/admin/vendor-notes/{vendorNote}', 'Admin\VendorNotesController@destroy' )->name( 'admin/vendor-notes/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/email-templates', 'Admin\EmailTemplatesController@index' );
    Route::get( '/admin/email-templates/create', 'Admin\EmailTemplatesController@create' );
    Route::post( '/admin/email-templates', 'Admin\EmailTemplatesController@store' );
    Route::get( '/admin/email-templates/{emailTemplate}/', 'Admin\EmailTemplatesController@show' )->name( 'admin/email-templates/show' );
    Route::get( '/admin/email-templates/{emailTemplate}/edit', 'Admin\EmailTemplatesController@edit' )->name( 'admin/email-templates/edit' );
    Route::post( '/admin/email-templates/{emailTemplate}', 'Admin\EmailTemplatesController@update' )->name( 'admin/email-templates/update' );
    Route::delete( '/admin/email-templates/{emailTemplate}', 'Admin\EmailTemplatesController@destroy' )->name( 'admin/email-templates/destroy' );
} );

/**
 * PDF Generation
 */

Route::get( '/admin/jcc-editor', function() {
    return view( 'admin.jcc.index' );
} );
Route::get( '/admin/projects/{id}/{type}/pdf', 'Admin\PDFController@create' );
Route::get( '/admin/projects/{id}/{type}/print', 'Admin\PDFController@print' );
Route::get( '/admin/projects/{id}/{type}/email', 'Admin\PDFController@create' );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/projects/{project}/lines', 'Admin\ProjectInvoiceLinesController@index' );
    Route::post( '/admin/projects/{project}/lines', 'Admin\ProjectInvoiceLinesController@store' );
    Route::post( '/admin/projects/{project}/lines/{line}', 'Admin\ProjectInvoiceLinesController@update' )->name( 'admin/project-invoice-lines/update' );
    Route::delete( '/admin/projects/{project}/lines/{line}', 'Admin\ProjectInvoiceLinesController@destroy' )->name( 'admin/project-invoice-lines/destroy' );

    Route::get( '/admin/purchase-orders/{purchaseOrder}/lines', 'Admin\PurchaseOrderInvoiceLinesController@index' );
    Route::post( '/admin/purchase-orders/{purchaseOrder}/lines', 'Admin\PurchaseOrderInvoiceLinesController@store' );
    Route::post( '/admin/purchase-orders/{purchaseOrder}/lines/{line}', 'Admin\PurchaseOrderInvoiceLinesController@update' );
    Route::delete( '/admin/purchase-orders/{purchaseOrder}/lines/{line}', 'Admin\PurchaseOrderInvoiceLinesController@destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/letter-heads', 'Admin\LetterHeadsController@index' );
    Route::get( '/admin/letter-heads/create', 'Admin\LetterHeadsController@create' );
    Route::post( '/admin/letter-heads', 'Admin\LetterHeadsController@store' );
    Route::get( '/admin/letter-heads/{letterHead}', 'Admin\LetterHeadsController@show' );
    Route::get( '/admin/letter-heads/{letterHead}/edit', 'Admin\LetterHeadsController@edit' )->name( 'admin/letter-heads/edit' );
    Route::post( '/admin/letter-heads/{letterHead}', 'Admin\LetterHeadsController@update' )->name( 'admin/letter-heads/update' );
    Route::delete( '/admin/letter-heads/{letterHead}', 'Admin\LetterHeadsController@destroy' )->name( 'admin/letter-heads/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/payment-terms', 'Admin\PaymentTermsController@index' );
    Route::get( '/admin/payment-terms/create', 'Admin\PaymentTermsController@create' );
    Route::post( '/admin/payment-terms', 'Admin\PaymentTermsController@store' );
    Route::get( '/admin/payment-terms/{paymentTerm}', 'Admin\PaymentTermsController@show' );
    Route::get( '/admin/payment-terms/{paymentTerm}/edit', 'Admin\PaymentTermsController@edit' )->name( 'admin/payment-terms/edit' );
    Route::post( '/admin/payment-terms/{paymentTerm}', 'Admin\PaymentTermsController@update' )->name( 'admin/payment-terms/update' );
    Route::delete( '/admin/payment-terms/{paymentTerm}', 'Admin\PaymentTermsController@destroy' )->name( 'admin/payment-terms/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/remittance-infos', 'Admin\RemittanceInfoController@index' );
    Route::get( '/admin/remittance-infos/create', 'Admin\RemittanceInfoController@create' );
    Route::post( '/admin/remittance-infos', 'Admin\RemittanceInfoController@store' );
    Route::get( '/admin/remittance-infos/{remittanceInfo}', 'Admin\RemittanceInfoController@show' );
    Route::get( '/admin/remittance-infos/{remittanceInfo}/edit', 'Admin\RemittanceInfoController@edit' )->name( 'admin/remittance-infos/edit' );
    Route::post( '/admin/remittance-infos/{remittanceInfo}', 'Admin\RemittanceInfoController@update' )->name( 'admin/remittance-infos/update' );
    Route::delete( '/admin/remittance-infos/{remittanceInfo}', 'Admin\RemittanceInfoController@destroy' )->name( 'admin/remittance-infos/destroy' );
} );


/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/leave-requests', 'Admin\LeaveRequestsController@index' );
    Route::get( '/admin/leave-requests/create', 'Admin\LeaveRequestsController@create' );
    Route::post( '/admin/leave-requests', 'Admin\LeaveRequestsController@store' );
    Route::get( '/admin/leave-requests/{leaveRequest}/edit', 'Admin\LeaveRequestsController@edit' )->name( 'admin/leave-requests/edit' );
    Route::post( '/admin/leave-requests/bulk-destroy', 'Admin\LeaveRequestsController@bulkDestroy' )->name( 'admin/leave-requests/bulk-destroy' );
    Route::get( '/admin/leave-requests/{leaveRequest}', 'Admin\LeaveRequestsController@show' );
    Route::post( '/admin/leave-requests/{leaveRequest}', 'Admin\LeaveRequestsController@update' )->name( 'admin/leave-requests/update' );
    Route::delete( '/admin/leave-requests/{leaveRequest}', 'Admin\LeaveRequestsController@destroy' )->name( 'admin/leave-requests/destroy' );
} );


/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/timesheets', 'Admin\TimesheetsController@index' );
    Route::get( '/admin/timesheets/create', 'Admin\TimesheetsController@create' );
    Route::post( '/admin/timesheets', 'Admin\TimesheetsController@store' );
    Route::get( '/admin/timesheets/{timesheet}/edit', 'Admin\TimesheetsController@edit' )->name( 'admin/timesheets/edit' );
    Route::post( '/admin/timesheets/bulk-destroy', 'Admin\TimesheetsController@bulkDestroy' )->name( 'admin/timesheets/bulk-destroy' );
    Route::post( '/admin/timesheets/{timesheet}', 'Admin\TimesheetsController@update' )->name( 'admin/timesheets/update' );
    Route::delete( '/admin/timesheets/{timesheet}', 'Admin\TimesheetsController@destroy' )->name( 'admin/timesheets/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/purchase-orders', 'Admin\PurchaseOrdersController@index' );
    Route::get( '/admin/purchase-orders/create', 'Admin\PurchaseOrdersController@create' );
    Route::post( '/admin/purchase-orders', 'Admin\PurchaseOrdersController@store' );
    Route::get( '/admin/purchase-orders/{purchaseOrder}/', 'Admin\PurchaseOrdersController@show' )->name( 'admin/purchase-orders/show' );
    Route::get( '/admin/purchase-orders/{purchaseOrder}/edit', 'Admin\PurchaseOrdersController@edit' )->name( 'admin/purchase-orders/edit' );
    Route::post( '/admin/purchase-orders/bulk-destroy', 'Admin\PurchaseOrdersController@bulkDestroy' )->name( 'admin/purchase-orders/bulk-destroy' );
    Route::post( '/admin/purchase-orders/{purchaseOrder}', 'Admin\PurchaseOrdersController@update' )->name( 'admin/purchase-orders/update' );
    Route::delete( '/admin/purchase-orders/{purchaseOrder}', 'Admin\PurchaseOrdersController@destroy' )->name( 'admin/purchase-orders/destroy' );
} );

/* Auto-generated admin routes */
Route::middleware( [ 'auth:' . config( 'admin-auth.defaults.guard' ), 'admin' ] )->group( function () {
    Route::get( '/admin/tasks', 'Admin\TasksController@index' );
    Route::get( '/admin/tasks/create', 'Admin\TasksController@create' );
    Route::post( '/admin/tasks', 'Admin\TasksController@store' );
    Route::get( '/admin/tasks/{task}/edit', 'Admin\TasksController@edit' )->name( 'admin/tasks/edit' );
    Route::post( '/admin/tasks/bulk-destroy', 'Admin\TasksController@bulkDestroy' )->name( 'admin/tasks/bulk-destroy' );
    Route::post( '/admin/tasks/{task}', 'Admin\TasksController@update' )->name( 'admin/tasks/update' );
    Route::delete( '/admin/tasks/{task}', 'Admin\TasksController@destroy' )->name( 'admin/tasks/destroy' );
} );


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/templates',                              'Admin\TemplatesController@index');
    Route::get('/admin/templates/create',                       'Admin\TemplatesController@create');
    Route::post('/admin/templates',                             'Admin\TemplatesController@store');
    Route::get('/admin/templates/{template}/',              'Admin\TemplatesController@show')->name('admin/templates/show');
    Route::get('/admin/templates/{template}/edit',              'Admin\TemplatesController@edit')->name('admin/templates/edit');
    Route::post('/admin/templates/bulk-destroy',                'Admin\TemplatesController@bulkDestroy')->name('admin/templates/bulk-destroy');
    Route::post('/admin/templates/{template}',                  'Admin\TemplatesController@update')->name('admin/templates/update');
    Route::delete('/admin/templates/{template}',                'Admin\TemplatesController@destroy')->name('admin/templates/destroy');
});
