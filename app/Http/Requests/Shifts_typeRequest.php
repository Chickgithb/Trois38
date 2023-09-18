<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Shifts_typeRequest extends FormRequest
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
            'type'=>'required',
            'from_time'=>'required',
            'to_time'=>'required',
            'total_hour'=>'required',
            'active'=>'required',

        ];
        
    }
    public function messages(){
        return[
            'type.required'=>'الحقل مطلوب',
            'from_time.required'=>'الحقل مطلوب',
            'to_time.required'=>'الحقل مطلوب',
            'total_hour.required'=>'الحقل مطلوب',
            'active.required'=>'الحقل مطلوب',
        ];
    }
}
