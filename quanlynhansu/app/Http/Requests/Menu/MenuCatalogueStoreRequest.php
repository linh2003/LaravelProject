<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class MenuCatalogueStoreRequest extends FormRequest
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
            'keyword' => 'required|unique:menu_catalogues',
        ];
    }
    public function messages(){
        return [
            'name.required' => __('Tên vị trí của menu không được trống'),
            'keyword.required' => __('Từ khóa của vị trí menu không được trống'),
            'keyword.unique' => __('Từ khóa của vị trí menu phải là duy nhất'),
        ];
    }
}
