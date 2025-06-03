<?php

namespace App\Rules\ProductCatalogue;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ProductCatalogue;

class ProductCatalogueRule implements ValidationRule
{
    protected $catId;
    public function __construct($catId){
        $this->catId = $catId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($this->catId);
        $cat = ProductCatalogue::find($this->catId);
        if ($cat->first()->rgt - $cat->first()->lft > 1) {
            $fail(__('productcatalogue.message.request.delChild'));
        }
    }
}
