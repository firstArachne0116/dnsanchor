<?php namespace App\Http\Requests\Admin\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePurchaseOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.purchase-order.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'project_id' => ['required', 'int'],
            'client_id'              => 'sometimes|nullable|int|exists:admin_users,id',
//            'contact_id'              => 'required|int|exists:admin_users,id',
//            'sales_representative_id' => 'int|exists:admin_users,id',
            'vendor_id'              => 'sometimes|nullable|int|exists:vendors,id',
            'vendor_payment_term_id' => 'sometimes|nullable|int|exists:vendor_payment_terms,id',

            'assigned_salesperson'  => 'nullable|array',
            'title'                 => 'nullable|string',
            'quantity'              => 'string|nullable',
            'trim_size'             => 'string|nullable',
            'extent'                => 'string|nullable',
            'orientation'           => 'string|nullable',
            'fields'                => 'array|nullable',
            'finishing_information' => 'string|nullable',
            'packaging_information' => 'string|nullable',
            'origination'           => 'string|nullable',
            'information_requests'  => 'string|nullable',
            'materials_in_at'       => 'integer|nullable',
            'fob_at'                => 'integer|nullable',
            'delivery_at'           => 'integer|nullable',
            'customer_shipping_to'  => 'string|nullable',
            'vendor_notes'          => 'string|nullable',

            'jcp_fields'           => 'array|nullable',
            'fcq_signed_at'        => 'integer|nullable',
            'invoice_lines_inc_po' => 'nullable|array',

            'project_stage_checklist' => 'nullable|array',
            'aa_template'             => 'nullable|string',
        ];
    }
}
