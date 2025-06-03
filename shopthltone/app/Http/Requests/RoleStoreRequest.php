<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'slug' => 'required|unique:roles'
        ];
    }
    public function messages(){
        return [
            'name.required' => __('role.message.request.name'),
            'slug.required' => __('role.message.request.slug.required'),
            'slug.unique' => __('role.message.request.slug.unique'),
        ];
    }
}
