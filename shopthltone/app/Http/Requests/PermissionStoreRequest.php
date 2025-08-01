<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:permissions',
        ];
    }
    public function messages(){
        return [
            'name.required' => __('permission.message.request.name'),
            'canonical.required' => __('permission.message.request.canonical.required'),
            'canonical.unique' => __('permission.message.request.canonical.unique'),
        ];
    }
}
