<?php

namespace App\Http\Requests;

use App\Rules\Attribute\AttributeRule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeDeleteRequest extends FormRequest
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
        $id = $this->only('id');
        return [
            'id' => [new AttributeRule($id)]
        ];
    }
}
