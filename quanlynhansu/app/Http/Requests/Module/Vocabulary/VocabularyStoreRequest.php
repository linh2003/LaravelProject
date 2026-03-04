<?php

namespace App\Http\Requests\Module\Vocabulary;

use Illuminate\Foundation\Http\FormRequest;

class VocabularyStoreRequest extends FormRequest
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
            'code' => 'required|unique:vocabulary_language,code',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Vocabulary name is required.',
            'code.required' => 'Vocabulary code is required',
            'code.unique' => 'Vocabulary code of role already exists. Please use a value different!',
        ];
    }
}
