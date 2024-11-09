<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users|max:191',
            'pass' => 'required|min:6',
            'confirm_pass' => 'required|same:pass',
        ];
    }
    public function messages() : array {
        return [
            'fullname.required' => 'The fullname field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email must be unique',
            'pass.required' => 'The password field is required.',
            'confirm_pass.required' => 'The confirm password field is required.',
            'confirm_pass.same' => 'The confirm password does not match the new password.',
        ];
    }
}
