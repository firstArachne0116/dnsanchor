<?php namespace App\Http\Requests\Admin\VendorNote;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateVendorNote extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.vendor-note.edit', $this->vendorNote);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name'    => 'required|sometimes|string',
            'note'    => 'required|sometimes|string',
            'default' => 'required|sometimes|boolean'
        ];
    }
}
