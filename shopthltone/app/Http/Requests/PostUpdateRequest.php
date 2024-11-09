<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'canonical' => 'required|unique:routers,canonical,'.$this->id.',post_id',
            'post_catalogue_id' => 'gt:0',
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'Tiêu đề bài viết không được để trống.',
            'canonical.required' => 'Đường dẫn SEO không được trống.',
            'canonical.unique' => 'Đường dẫn SEO đã tồn tại. Vui lòng nhập đường dẫn khác',
            'post_catalogue_id.gt' => 'Danh mục không được để trống',
        ];
    }
}
