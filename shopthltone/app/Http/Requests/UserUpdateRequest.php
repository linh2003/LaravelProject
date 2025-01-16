<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'Bạn chưa nhập tên người dùng.',
            'email.required' => 'Bạn chưa nhập email người dùng.',
            'email.email' => 'Email phải đúng định dạng abc@domain.xyz',
            'email.unique' => 'Email phải là duy nhất',
        ];
    }
}
