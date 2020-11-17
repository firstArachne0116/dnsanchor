<?php namespace App\Http\Requests\Admin\EmailTemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEmailTemplate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.email-template.edit', $this->emailTemplate);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'header' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'footer' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            
        ];
    }
}
