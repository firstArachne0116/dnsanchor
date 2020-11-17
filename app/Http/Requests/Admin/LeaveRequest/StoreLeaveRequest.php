<?php namespace App\Http\Requests\Admin\LeaveRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.leave-request.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'requested_dates' => [ 'required', 'array' ],
            'pto' => [ 'required', 'string' ],
            'purpose' => [ 'required', 'string' ],
            'period' => [ 'required', 'string' ],
        ];
    }
}
