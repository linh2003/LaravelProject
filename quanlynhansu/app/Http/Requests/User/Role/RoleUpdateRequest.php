<?php

namespace App\Http\Requests\User\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'code' => 'required|unique:roles,machine_name,'.$this->id,
        ];
    }
    public function messages(){
        return [
            'name.required' => __('role.message.request.name'),
            'code.required' => __('role.message.request.code.required'),
            'code.unique' => __('role.message.request.code.unique'),
        ];
    }
}
