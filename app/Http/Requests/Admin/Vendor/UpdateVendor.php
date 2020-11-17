<?php namespace App\Http\Requests\Admin\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateVendor extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize() {
        return Gate::allows( 'admin.vendor.edit', $this->vendor );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules() {
        return [
            'name'                     => 'sometimes|required|string',
            'phone'                    => 'sometimes|string|nullable',
            'fax'                      => 'sometimes|string|nullable',
            'timezone'                 => 'sometimes|string|nullable',
            'suite'                  => 'sometimes|string|nullable',
            'category' => 'array|nullable',
            'website'                  => 'sometimes|string|nullable',
            'billing_address_street'   => 'sometimes|string|nullable',
            'billing_address_city'     => 'sometimes|string|nullable',
            'billing_address_state'    => 'sometimes|string|nullable',
            'billing_address_zip_code' => 'sometimes|string|nullable',
            'billing_address_country'  => 'sometimes|string|nullable',

            'assigned_salesperson'                        => 'sometimes|nullable|array',
//            'sales_representative_id'     => 'string|nullable',
            'primary_contact_name'                        => 'sometimes|string|nullable',
            'primary_contact_phone'                       => 'sometimes|string|nullable',
            'primary_contact_email'                       => 'sometimes|string|nullable',
            'primary_contact_address'                     => 'sometimes|string|nullable',
            'primary_contact_job_title'                   => 'sometimes|string|nullable',
//            'primary_contact_status'      => 'string|nullable',
            'primary_contact_communication_preferences'   => 'sometimes|array|nullable',
            //
            'secondary_contact_name'                      => 'sometimes|string|nullable',
            'secondary_contact_phone'                     => 'sometimes|string|nullable',
            'secondary_contact_email'                     => 'sometimes|string|nullable',
            'secondary_contact_address'                   => 'sometimes|string|nullable',
            'secondary_contact_job_title'                 => 'sometimes|string|nullable',
            'secondary_contact_status'                    => 'sometimes|string|nullable',
            'secondary_contact_communication_preferences' => 'sometimes|array|nullable',

            //
            'sales_contact_name'                          => 'sometimes|string|nullable',
            'sales_contact_phone'                         => 'sometimes|string|nullable',
            'sales_contact_email'                         => 'sometimes|string|nullable',
            'sales_contact_address'                       => 'sometimes|string|nullable',
            'sales_contact_status'                        => 'sometimes|string|nullable',
            'sales_contact_communication_preferences'     => 'sometimes|array|nullable',

            //
            'design_contact_name'                         => 'sometimes|string|nullable',
            'design_contact_phone'                        => 'sometimes|string|nullable',
            'design_contact_email'                        => 'sometimes|string|nullable',
            'design_contact_address'                      => 'sometimes|string|nullable',
            'design_contact_status'                       => 'sometimes|string|nullable',
            'design_contact_communication_preferences'    => 'sometimes|array|nullable',

            //
            'financial_contact_name'                      => 'sometimes|string|nullable',
            'financial_contact_phone'                     => 'sometimes|string|nullable',
            'financial_contact_email'                     => 'sometimes|string|nullable',
            'financial_contact_address'                   => 'sometimes|string|nullable',
            'financial_contact_status'                    => 'sometimes|string|nullable',
            'financial_contact_communication_preferences' => 'sometimes|array|nullable',


            'notes' => 'sometimes|nullable|string',
        ];
    }
}
