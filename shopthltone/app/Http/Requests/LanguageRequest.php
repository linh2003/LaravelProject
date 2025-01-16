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
            'canonical' => 'required|unique:languages',
        ];
    }
    public function messages() : array {
        return [
            'name.required' => 'Bạn chưa nhập tên của ngôn ngữ.',
            'canonical.required' => 'Bạn chưa nhập machine name của ngôn ngữ.',
            'canonical.unique' => 'Machine name đã tồn tại. Vui lòng nhập machine name khác!',
        ];
    }
}
