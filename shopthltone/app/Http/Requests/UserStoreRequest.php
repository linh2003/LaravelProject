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
            'name' => 'required',
            'email' => 'required|email|unique:users|max:191',
            'pass' => 'required|min:6',
            'confirm_pass' => 'required|same:pass',
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'Bạn chưa nhập tên người dùng.',
            'email.required' => 'Bạn chưa nhập email người dùng.',
            'email.email' => 'Email phải đúng định dạng abc@domain.xyz',
            'email.unique' => 'Email đã tồn tại. Vui lòng nhập email khác',
            'pass.required' => 'Bạn chưa nhập mật khẩu.',
            'confirm_pass.required' => 'Bạn chưa nhập xác nhận mật khẩu.',
            'confirm_pass.same' => 'Xác nhận mật khẩu không khớp với mật khẩu.',
        ];
    }
}
