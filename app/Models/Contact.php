<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = [
        'type',
        'timezone',
        'primary_contact_name',
        'primary_contact_phone',
        'primary_contact_email',
        'primary_contact_address',
        'primary_contact_job_title',
        'primary_contact_status',
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
        //
        'company_name',
        'company_phone',
        'company_address',
        'shipping_address',
        'website',
        'social_media',
        'source',
        'referred_by',
    ];

    protected $hidden = [

    ];

    protected $dates = [

    ];

    protected $casts = [
        'primary_contact_communication_preferences' => 'array',
        'secondary_contact_communication_preferences' => 'array',
        'sales_contact_communication_preferences' => 'array',
        'design_contact_communication_preferences' => 'array',
        'financial_contact_communication_preferences' => 'array',
        'social_media' => 'array',
    ];

    protected $with = [ 'sales_persons' ];

    public $timestamps = true;

    protected $appends = ['resource_url', 'name', 'company_address_formatted'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/contacts/'.$this->getKey());
    }

    public function getNameAttribute() {
        if ( $name = $this->attributes[ 'primary_contact_name' ] ) {
            return $name;
        }

        if ( $name = $this->attributes[ 'company_name' ] ) {
            return $name;
        }
    }

    public function getCompanyAddressFormattedAttribute() {
        return str_replace( ',', ',<br>', $this->company_address );
    }

    public function sales_persons() {
        return $this->belongsToMany( AdminUser::class, 'contact_salespersons', 'contact_id', 'salesperson_id' );
    }

}
