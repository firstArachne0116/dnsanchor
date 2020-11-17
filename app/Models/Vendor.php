<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 *
 * @package App\Models
 */
class Vendor extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'fax',
        'timezone',
        'suite',
        'website',

        "category_id",

        'billing_address_street',
        'billing_address_city',
        'billing_address_state',
        'billing_address_zip_code',
        'billing_address_country',

        'sales_representative_id',
        'primary_contact_name',
        'primary_contact_phone',
        'primary_contact_email',
        'primary_contact_address',
        'primary_contact_job_title',
        'primary_contact_communication_preferences',

        //
        'secondary_contact_name',
        'secondary_contact_phone',
        'secondary_contact_email',
        'secondary_contact_address',
        'secondary_contact_job_title',
        'secondary_contact_status',
        'secondary_contact_communication_preferences',

        //
        'sales_contact_name',
        'sales_contact_phone',
        'sales_contact_email',
        'sales_contact_address',
        'sales_contact_status',
        'sales_contact_communication_preferences',

        //
        'design_contact_name',
        'design_contact_phone',
        'design_contact_email',
        'design_contact_address',
        'design_contact_status',
        'design_contact_communication_preferences',

        //
        'financial_contact_name',
        'financial_contact_phone',
        'financial_contact_email',
        'financial_contact_address',
        'financial_contact_status',
        'financial_contact_communication_preferences',


        'notes',
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $dates = [

    ];

    /**
     * @var array
     */
    protected $casts = [
        'primary_contact_communication_preferences'   => 'array',
        'secondary_contact_communication_preferences' => 'array',
        'sales_contact_communication_preferences'     => 'array',
        'design_contact_communication_preferences'    => 'array',
        'financial_contact_communication_preferences' => 'array',
        'social_media'                                => 'array',
    ];

    /**
     * @var bool
     */
    public $timestamps = true;

    protected $with = [ 'sales_persons', 'category' ];

    /**
     * @var array
     */
    protected $appends = [ 'resource_url' ];

    /* ************************ ACCESSOR ************************* */

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getResourceUrlAttribute() {
        return url( '/admin/vendors/' . $this->getKey() );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales_persons() {
        return $this->belongsToMany( AdminUser::class, 'vendor_salespersons', 'vendor_id', 'salesperson_id' );
    }

    public function category() {
        return $this->belongsTo( VendorCategory::class, 'category_id' );
    }
}
