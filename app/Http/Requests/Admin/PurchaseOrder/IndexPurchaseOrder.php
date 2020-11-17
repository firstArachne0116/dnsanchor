<?php namespace App\Http\Requests\Admin\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexPurchaseOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.purchase-order.index');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'orderBy' => 'in:id,project_id,type,vendor_id,contact_id,sales_representative_id,approved_manager_id,approval_requested_by,template_type,title,quantity,trim_size,information_requests,extent,origination,finishing_information,packaging_information,vendor_notes,customer_shipping_to,remittance_id,payment_term_id,fob_at,materials_in_at,delivery_at,approved_at|nullable',
            'orderDirection' => 'in:asc,desc|nullable',
            'search' => 'string|nullable',
            'page' => 'integer|nullable',
            'per_page' => 'integer|nullable',

        ];
    }
}
