<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Branches_Request extends FormRequest
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
            'name'=>'required',
            'phones'=>'required',
            'email'=>'required',
            'address'=>'required',
            'active'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'اسم الفرع مطلوب',
            'phones.required'=>'رقم الهاتف مطلوب',
            'email.required'=>'عنوان البريد مطلوب',
            'address.required'=>' العنوان مطلوب',
            'active.required'=>'حالة التفعيل مطلوب',
        ];
    }
}
