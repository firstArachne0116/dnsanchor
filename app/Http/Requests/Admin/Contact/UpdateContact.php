<?php namespace App\Http\Requests\Admin\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.contact.edit', $this->contact);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'type'                        => 'required|sometimes|array|nullable',
            'assigned_salesperson'        => 'nullable|array',
            'primary_contact_name'        => 'string|nullable',
            'primary_contact_phone'       => 'string|nullable',
            'primary_contact_email'       => 'string|nullable',
            'primary_contact_address'     => 'string|nullable',
            'primary_contact_job_title'   => 'string|nullable',
            'primary_contact_status'      => 'string|nullable',
            'primary_contact_communication_preferences' => 'array|nullable',
            //
            'secondary_contact_name'      => 'string|nullable',
            'secondary_contact_phone'     => 'string|nullable',
            'secondary_contact_email'     => 'string|nullable',
            'secondary_contact_address'   => 'string|nullable',
            'secondary_contact_job_title' => 'string|nullable',
            'secondary_contact_status'    => 'string|nullable',
            'secondary_contact_communication_preferences' => 'array|nullable',

            //
            'sales_contact_name'          => 'string|nullable',
            'sales_contact_phone'         => 'string|nullable',
            'sales_contact_email'         => 'string|nullable',
            'sales_contact_address'       => 'string|nullable',
            'sales_contact_status'        => 'string|nullable',
            'sales_contact_communication_preferences' => 'array|nullable',

            //
            'design_contact_name'         => 'string|nullable',
            'design_contact_phone'        => 'string|nullable',
            'design_contact_email'        => 'string|nullable',
            'design_contact_address'      => 'string|nullable',
            'design_contact_status'       => 'string|nullable',
            'design_contact_communication_preferences' => 'array|nullable',

            //
            'financial_contact_name'      => 'string|nullable',
            'financial_contact_phone'     => 'string|nullable',
            'financial_contact_email'     => 'string|nullable',
            'financial_contact_address'   => 'string|nullable',
            'financial_contact_status'    => 'string|nullable',
            'financial_contact_communication_preferences' => 'array|nullable',

            //
            'company_name'                => 'string|nullable',
            'company_phone'               => 'string|nullable',
            'company_address'             => 'string|nullable',
            'shipping_address'            => 'string|nullable',
            'timezone'                     => 'string|nullable',
            'website'                     => 'string|nullable',
            'social_media'                => 'array|nullable',
            'source'                      => 'array|nullable',
            'referred_by'                 => 'int|nullable',
        ];
    }
}
