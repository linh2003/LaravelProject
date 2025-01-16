<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCatStoreRequest extends FormRequest
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
            'name.required' => __('product_catalogue.message.request.name'),
            'canonical.required' => __('product_catalogue.message.request.canonical.required'),
            'canonical.unique' => __('product_catalogue.message.request.canonical.unique'),
        ];
    }
}
