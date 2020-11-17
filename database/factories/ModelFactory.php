<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Vendor::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Vendor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'phone' => $faker->sentence,
        'website' => $faker->sentence,
        'primary_first_name' => $faker->sentence,
        'primary_last_name' => $faker->sentence,
        'primary_email' => $faker->sentence,
        'primary_phone' => $faker->sentence,
        'primary_position' => $faker->sentence,
        'billing_address_street' => $faker->sentence,
        'billing_address_city' => $faker->sentence,
        'billing_address_state' => $faker->sentence,
        'billing_address_zip_code' => $faker->sentence,
        'billing_address_country' => $faker->sentence,
        'notes' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Contact::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Contact::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->sentence,
        'sales_representative_id' => $faker->randomNumber(5),
        'primary_contact_name' => $faker->sentence,
        'primary_contact_phone' => $faker->sentence,
        'primary_contact_email' => $faker->sentence,
        'primary_contact_address' => $faker->text(),
        'primary_contact_job_title' => $faker->sentence,
        'primary_contact_status' => $faker->sentence,
        'secondary_contact_name' => $faker->sentence,
        'secondary_contact_phone' => $faker->sentence,
        'secondary_contact_email' => $faker->sentence,
        'secondary_contact_address' => $faker->text(),
        'secondary_contact_job_title' => $faker->sentence,
        'secondary_contact_status' => $faker->sentence,
        'sales_contact_name' => $faker->sentence,
        'sales_contact_phone' => $faker->sentence,
        'sales_contact_email' => $faker->sentence,
        'sales_contact_address' => $faker->text(),
        'sales_contact_status' => $faker->sentence,
        'design_contact_name' => $faker->sentence,
        'design_contact_phone' => $faker->sentence,
        'design_contact_email' => $faker->sentence,
        'design_contact_address' => $faker->text(),
        'design_contact_status' => $faker->sentence,
        'financial_contact_name' => $faker->sentence,
        'financial_contact_phone' => $faker->sentence,
        'financial_contact_email' => $faker->sentence,
        'financial_contact_address' => $faker->text(),
        'financial_contact_status' => $faker->sentence,
        'company_name' => $faker->sentence,
        'company_phone' => $faker->sentence,
        'company_address' => $faker->text(),
        'shipping_address' => $faker->text(),
        'website' => $faker->sentence,
        'social_media' => $faker->text(),
        'source' => $faker->sentence,
        'referred_by' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Project::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\AccessLog::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\VendorCategory::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Setting::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'guard_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\CustomerCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Orientation::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ProjectType::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\VendorNote::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EmailTemplate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'header' => $faker->text(),
        'body' => $faker->text(),
        'footer' => $faker->text(),
        'published_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ProjectInvoice::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ProjectInvoiceLine::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\LetterHead::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\LeaveRequest::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Timesheet::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\PurchaseOrder::class, function (Faker\Generator $faker) {
    return [
        'project_id' => $faker->sentence,
        'type' => $faker->sentence,
        'vendor_id' => $faker->sentence,
        'contact_id' => $faker->sentence,
        'sales_representative_id' => $faker->randomNumber(5),
        'approved_manager_id' => $faker->randomNumber(5),
        'approval_requested_by' => $faker->randomNumber(5),
        'template_type' => $faker->sentence,
        'title' => $faker->sentence,
        'quantity' => $faker->sentence,
        'trim_size' => $faker->sentence,
        'information_requests' => $faker->sentence,
        'extent' => $faker->sentence,
        'origination' => $faker->sentence,
        'finishing_information' => $faker->sentence,
        'packaging_information' => $faker->sentence,
        'vendor_notes' => $faker->sentence,
        'customer_shipping_to' => $faker->sentence,
        'additional_comments' => $faker->text(),
        'remittance_id' => $faker->randomNumber(5),
        'payment_term_id' => $faker->randomNumber(5),
        'fob_at' => $faker->dateTime,
        'materials_in_at' => $faker->dateTime,
        'delivery_at' => $faker->dateTime,
        'approved_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Task::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Template::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

