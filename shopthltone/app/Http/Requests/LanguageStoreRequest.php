<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
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
            'canonical' => 'required|unique:languages',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên ngôn ngữ đang trống',
            'canonical.required' => 'Canonical của ngôn ngữ đang trống',
            'canonical.unique' => 'Canonical của ngôn ngữ đã tồn tại. Vui lòng nhập giá trị khác!',
        ];
    }
}
