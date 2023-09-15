<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class finance_calenders_Request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'FINANCE_YR'=> 'required|unique:finance_calenders',
            'FINANCE_YR_DESC' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'FINANCE_YR.required' =>'كود السنة المالية مطلوب',
            'FINANCE_YR.unique' =>'كود السنة مسجل من قبل',
            'FINANCE_YR_DESC.required'=>'وصف السنة مسجل من قبل',
            'start_date.required'=>'تاريخ نهاية السنة الماليةاجباري',
            'end_date.required'=>'تاريخ بداية السنة المالية اجباري'
        ];
    }
}
