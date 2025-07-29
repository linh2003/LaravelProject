<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
        ];
    }
    public function messages(){
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email',
            'email.exists' => "Email doesn't exists",
            'password.required' => "Password is required",
            'password.min' => "Password must be at least 5 characters",
            'password.confirm' => "Confirm password do not match with Password!",
        ];
    }
}
