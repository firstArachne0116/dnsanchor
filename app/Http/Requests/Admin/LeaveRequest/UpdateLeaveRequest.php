<?php namespace App\Http\Requests\Admin\LeaveRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.leave-request.edit', $this->leaveRequest);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'requested_dates' => [ 'required', 'sometimes', 'array' ],
            'pto'             => [ 'required', 'sometimes', 'string' ],
            'purpose'         => [ 'required', 'sometimes', 'string' ],
            'period'          => [ 'required', 'sometimes', 'string' ],
            'approval'          => [ 'required', 'sometimes', 'string' ],
        ];
    }


    /**
    * Modify input data
    *
    * @return  array
    */
    public function getSanitized()
    {
        $sanitized = $this->validated();

        $sanitized[ 'user_id' ] = $this->user()->id;

        //Add your code for manipulation with request data here

        return $sanitized;
    }

}
