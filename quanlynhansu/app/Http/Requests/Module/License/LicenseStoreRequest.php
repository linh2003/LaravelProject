<?php

namespace App\Http\Requests\Module\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Constants\Number;

class LicenseStoreRequest extends FormRequest
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
        $unitMultiple = Number::NGHI_NHIEU_NGAY;
        return [
            'start_date' => 'required|date|before:end_date',
            'reason_leave' => 'required',
            'end_date' => [
                Rule::requiredIf(function () use ($unitMultiple){
                    return $this->input('license_unit') == $unitMultiple;
                }),
                'nullable,
                date,
                after:start_date'
            ],
        ];
    }
    public function messages(){
        return [
            'start_date.required' => __('license.message.request.start_date'),
            'end_date.required' => __('license.message.request.end_date'),
            'start_date.date' => __('license.message.request.date'),
            'reason.required' => 'Lý do trống',
        ];
    }
}
