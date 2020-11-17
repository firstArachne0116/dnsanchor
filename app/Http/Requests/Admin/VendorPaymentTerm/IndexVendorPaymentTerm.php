<?php namespace App\Http\Requests\Admin\VendorPaymentTerm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexVendorPaymentTerm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.vendor-payment-term.index');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'orderBy'        => 'in:id,name|nullable',
            'orderDirection' => 'in:asc,desc|nullable',
            'search'         => 'string|nullable',
            'page'           => 'integer|nullable',
            'per_page'       => 'integer|nullable',

        ];
    }
}
