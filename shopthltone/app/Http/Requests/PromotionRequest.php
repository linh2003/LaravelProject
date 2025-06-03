<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Promotion\PromotionObjectRule;
use App\Enums\Promotion;

class PromotionRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'start' => 'required',
        ];
        $rules['type'] = ['required', function($attribute, $value, $fail){
            if ($value == Promotion::PROMOTION_NONE) {
                $fail(__('promotion.message.request.type_promotion'));
            }
        }];
        $type_promotion = $this->only('type');
        $radio_promotion = $this->only('product_promotion');
        // dd($type_promotion);
        if ($type_promotion['type'] == Promotion::PROMOTION_PRODUCT) {
            $rules['module'] = ['required', function($attribute, $value, $fail){
                if ($value == null) {
                    $fail(__('promotion.message.request.product_promotion'));
                }
            }];
        }
        
        return $rules;
    }
    public function messages(){
        return [
            'name.required' => __('promotion.message.request.name'),
            'code.required' => __('promotion.message.request.code'),
            'start.required' => __('promotion.message.request.start'),
        ];
    }
}
