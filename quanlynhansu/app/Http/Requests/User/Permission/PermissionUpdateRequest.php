<?php

namespace App\Http\Requests\User\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
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
            'canonical' => 'required|unique:permissions,canonical,'.$this->id,
        ];
    }
    public function messages(){
        return [
            'name.required' => __('role.message.request.name'),
            'canonical.required' => __('role.message.request.canonical.required'),
            'canonical.unique' => __('role.message.request.canonical.unique'),
        ];
    }
}
