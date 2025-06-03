<?php

namespace App\Rules\Attribute;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\AttributeType;

class AttributeTypeRule implements ValidationRule
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
        // dd($this->id);
        // $atType = AttributeType::find($this->id)->with('attributes');
        $atType = AttributeType::join('attribute_type_attribute as tb1', 'attribute_types.id', '=', 'tb1.attribute_type_id')->find($this->id);
        if(count($atType->toArray())){
            $fail(__('attribute_type.message.request.delete'));
        }
    }
}
