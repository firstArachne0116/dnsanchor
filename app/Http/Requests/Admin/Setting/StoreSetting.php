<?php namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSetting extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize() {
        return Gate::allows( 'admin.setting.create' );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules() {
        return [
            'name'        => 'required|string',
            'guard_name'  => 'required|string',
            'permissions' => 'required|array',
        ];
    }
}
