<?php

namespace App\Rules\Attribute;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Attribute;

class AttributeRule implements ValidationRule
{
    protected $id;
    public function __construct($id){
        $this->id = $id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $id = Attribute::join('product_variant_attributes as tb1', 'attributes.id', '=', 'tb1.attribute_id')->find($this->id);
        if (count($id->toArray()) > 0) {
            $fail(__('attribute.message.request.delete'));
        }
    }
}
