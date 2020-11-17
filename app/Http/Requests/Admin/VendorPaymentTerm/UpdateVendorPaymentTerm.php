<?php namespace App\Http\Requests\Admin\VendorPaymentTerm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateVendorPaymentTerm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.vendor-payment-term.edit', $this->vendorPaymentTerm);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name'    => [ 'sometimes', 'string' ],
            'default' => [ 'sometimes', 'boolean', 'nullable' ],
        ];
    }
}
