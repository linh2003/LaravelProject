<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeTypeStoreRequest extends FormRequest
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
            'canonical' => 'required|unique:routers',
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'Tiêu đề nhóm thuộc tính không được để trống.',
            'canonical.required' => 'Đường dẫn SEO không được trống.',
            'canonical.unique' => 'Đường dẫn SEO đã tồn tại. Vui lòng nhập giá trị khác',
        ];
    }
}
