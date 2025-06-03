<?php

namespace App\Http\Requests;

use App\Rules\ProductCatalogue\ProductCatalogueRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductCatDelRequest extends FormRequest
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
        $catId = $this->only('id');
        // dd($cat);
        $rules = [
            'id' => [new ProductCatalogueRule($catId)]
        ];
        return $rules;
    }
}
