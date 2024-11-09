<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'canonical' => 'required|unique:post_catalogue_languages',
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'The language name field is required.',
            'canonical.required' => 'The language canonical field is required.',
            'canonical.unique' => 'Đường dẫn đã tồn tại. Vui lòng nhập đường dẫn khác',
        ];
    }
}
