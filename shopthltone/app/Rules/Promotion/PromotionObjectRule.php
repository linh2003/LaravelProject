<?php

namespace App\Rules\Promotion;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromotionObjectRule implements ValidationRule
{
    protected $data;
    public function __construct($request){
        $this->data = $request;
        // dd($this->data);
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $data = $this->data;
        dd(123);
        // if ($data['type_promotion'] == 'none') {
        //     $fail('123');
        // }
        $fail('dieptv');
    }
}
