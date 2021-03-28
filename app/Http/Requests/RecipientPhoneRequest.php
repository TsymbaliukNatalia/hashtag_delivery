<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientPhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone_recipient' => 'required|regex:/(\+380)[0-9]{9}/|size:13'
        ];
    }

    public function messages()
    {
        return [
            'phone_recipient.required' => 'Поле "Телефон отримувача" обов`язкове для заповнення',
            'phone_recipient.regex' => 'Некоректний формат телефонного номеру',
            'phone_recipient.size' => 'Некоректний формат телефонного номеру'
        ];
    }
    
}
