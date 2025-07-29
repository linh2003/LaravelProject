<?php

namespace App\Http\Requests\User\User;

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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|unique:users',
        ];
    }
    public function messages(){
        return [
            'name.required' => __('user.message.request.name'),
            'email.required' => __('user.message.request.email.required'),
            'email.unique' => __('user.message.request.email.unique'),
            'password.required' => __('user.message.request.password.required'),
            'password.min' => __('user.message.request.password.min'),
            'phone.required' => __('user.message.request.phone.required'),
            'phone.unique' => __('user.message.request.phone.unique'),
        ];
    }
}
