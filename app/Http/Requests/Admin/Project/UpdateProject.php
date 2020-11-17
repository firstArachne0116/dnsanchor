<?php namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.project.edit', $this->project);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'contact_id'            => 'sometimes|nullable|int|exists:admin_users,id',
            'client_id'            => 'sometimes|nullable|int|exists:admin_users,id',
            'vendor_id'            => 'sometimes|nullable|int|exists:vendors,id',
            'vendor_payment_term_id'            => 'sometimes|nullable|int|exists:vendor_payment_terms,id',
            'assigned_salesperson' => 'nullable|array',
            'payment_term_id' => 'sometimes|nullable|int|exists:payment_terms,id',
            'title'                 => 'sometimes|nullable|string',
            'quantity'              => 'sometimes|string|nullable',
            'trim_size'             => 'sometimes|string|nullable',
            'extent'                => 'sometimes|string|nullable',
            'orientation'           => 'sometimes|string|nullable',
            'fields'                => 'sometimes|sometimes|array|nullable',
            'finishing_information' => 'sometimes|string|nullable',
            'packaging_information' => 'sometimes|string|nullable',
            'additional_comments' => 'sometimes|string|nullable',
            'origination'           => 'sometimes|string|nullable',
            'information_requests'  => 'sometimes|string|nullable',
            'materials_in_at'       => 'sometimes|int|nullable',
            'fob_at'                => 'sometimes|int|nullable',
            'delivery_at'           => 'sometimes|int|nullable',
            'customer_shipping_to'    => 'sometimes|string|nullable',
            'vendor_notes'          => 'sometimes|string|nullable',
            'template_type'          => 'required|string|nullable',
            'saved_as_official' => 'required|sometimes|boolean',

            'jcp_fields' => 'array|nullable',
            'fcq_signed_at' => 'integer|nullable',
            'invoice_lines_inc_po' => 'nullable|array',
            'sales_invoice_lines' => 'nullable|array',

            'project_stage_checklist' => 'nullable|array',
            'aa_template' => 'nullable|string',
        ];
    }
}
