<?php namespace App\Http\Requests\Admin\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PatchContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return true;
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
            'assigned_salesperson'        => 'required|sometimes|nullable|array',
            'primary_contact_name'        => 'string|nullable',
            'primary_contact_phone'       => 'string|nullable',
            'primary_contact_email'       => 'string|nullable',
            'primary_contact_address'     => 'string|nullable',
            'primary_contact_job_title'   => 'string|nullable',
            'primary_contact_status'      => 'string|nullable',
            //
            'secondary_contact_name'      => 'string|nullable',
            'secondary_contact_phone'     => 'string|nullable',
            'secondary_contact_email'     => 'string|nullable',
            'secondary_contact_address'   => 'string|nullable',
            'secondary_contact_job_title' => 'string|nullable',
            'secondary_contact_status'    => 'string|nullable',
            //
            'sales_contact_name'          => 'string|nullable',
            'sales_contact_phone'         => 'string|nullable',
            'sales_contact_email'         => 'string|nullable',
            'sales_contact_address'       => 'string|nullable',
            'sales_contact_status'        => 'string|nullable',
            //
            'design_contact_name'         => 'string|nullable',
            'design_contact_phone'        => 'string|nullable',
            'design_contact_email'        => 'string|nullable',
            'design_contact_address'      => 'string|nullable',
            'design_contact_status'       => 'string|nullable',
            //
            'financial_contact_name'      => 'string|nullable',
            'financial_contact_phone'     => 'string|nullable',
            'financial_contact_email'     => 'string|nullable',
            'financial_contact_address'   => 'string|nullable',
            'financial_contact_status'    => 'string|nullable',
            //
            'company_name'                => 'required|sometimes|string|nullable',
            'company_phone'               => 'required|sometimes|string|nullable',
            'company_address'             => 'required|sometimes|string|nullable',
            'shipping_address'            => 'required|sometimes|string|nullable',
            'website'                     => 'required|sometimes|string|nullable',
            'social_media'                => 'required|sometimes|string|nullable',
            'source'                      => 'required|sometimes|array|nullable',
            'referred_by'                 => 'required|sometimes|array|nullable',
        ];
    }
}
