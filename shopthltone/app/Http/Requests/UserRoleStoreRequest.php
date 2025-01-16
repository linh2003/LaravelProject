<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleStoreRequest extends FormRequest
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
            'slug' => 'required|unique:roles',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên nhóm thành viên.',
            'slug.required' => 'Bạn chưa nhập machine name nhóm thành viên.',
            'slug.unique'   => 'Machine name nhóm thành viên đã tồn tại. Vui lòng nhập lại!',
        ];
    }
}
