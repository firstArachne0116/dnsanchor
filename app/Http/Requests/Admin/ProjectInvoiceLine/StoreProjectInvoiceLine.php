<?php namespace App\Http\Requests\Admin\ProjectInvoiceLine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreProjectInvoiceLine extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.project-invoice-line.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'project_id'  => 'required|sometimes|integer',
            'purchase_order_id'  => 'required|sometimes|integer',
            'name'        => 'required|string|sometimes',
            'description' => 'required|string|sometimes',
            'quantity'    => 'required|string|sometimes',
            'unit_cost'   => 'required|string|sometimes',
            'unit_price'  => 'required|string|sometimes',
            'category'  => 'required|string|sometimes',
        ];
    }
}
