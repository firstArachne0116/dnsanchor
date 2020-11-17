<?php namespace App\Http\Requests\Admin\PurchaseOrderInvoiceLine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePurchaseOrderInvoiceLine extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.project-invoice-line.edit', $this->projectInvoiceLine);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [

        ];
    }
}
