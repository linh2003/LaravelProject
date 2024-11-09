<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'fullname' => 'required',
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
        ];
    }
    public function messages() : array {
        return [
            'fullname.required' => 'The fullname field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email must be unique',
        ];
    }
}
