<?php

namespace App\Http\Requests;

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
    public function messages() : array {
        return [
            'name.required' => 'Bạn chưa nhập tên quyền sử dụng.',
            'canonical.required' => 'Bạn chưa nhập machine name quyền sử dụng.',
            'canonical.unique' => 'Machine name quyền sử dụng đã tồn tại. Vui lòng nhập dữ liệu khác!',
        ];
    }
}
