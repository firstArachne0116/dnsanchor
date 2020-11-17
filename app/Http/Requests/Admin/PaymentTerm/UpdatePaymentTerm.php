<?php namespace App\Http\Requests\Admin\PaymentTerm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePaymentTerm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.payment-term.edit', $this->paymentTerm);
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
            'default' => [ 'sometimes', 'boolean' ],
        ];
    }
}
