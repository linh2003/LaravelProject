<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCatalogueStoreRequest extends FormRequest
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
    public function messages(){
        return [
            'name.required' => __('productcatalogue.message.request.name'),
            'canonical.required' => __('productcatalogue.message.request.canonical.required'),
            'canonical.unique' => __('productcatalogue.message.request.canonical.unique'),
        ];
    }
}
