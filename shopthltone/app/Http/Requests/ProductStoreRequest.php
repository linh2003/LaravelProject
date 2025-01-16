<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'catalogue' => 'required'
        ];
    }
    public function messages() : array {
        return [
            'name.required' => __('product.message.request.name'),
            'canonical.required' => __('product.message.request.canonical.required'),
            'canonical.unique' => __('product.message.request.canonical.unique'),
            'catalogue.required' => __('product.message.request.catalogue'),
        ];
    }
}
