<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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

    public function rules()
    {
        return [
            'phone_user' => 'required|regex:/(\+380)[0-9]{9}/|size:13',
            'surname_user' => 'required|alpha|min:2',
            'name_user' => 'required|alpha|min:2',
            'middle_name_user' => 'alpha|min:2',
            'point_user' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'phone_user.required' => 'Поле "Телефон" обов`язкове для заповнення',
            'phone_user.regex' => 'Некоректний формат телефонного номеру',
            'phone_user.size' => 'Некоректний формат телефонного номеру',
            'surname_user.required' => 'Поле "Прізвище" обов`язкове для заповнення',
            'surname_user.alpha' => 'Поле "Прізвище" повинно містити лише алфавітні символи',
            'surname_user.min' => 'Поле "Прізвище" повинно містити не менше 2 символів',
            'name_user.required' => 'Поле "Ім`я" обов`язкове для заповнення',
            'name_user.alpha' => 'Поле "Ім`я" повинно містити лише алфавітні символи',
            'name_user.min' => 'Поле "Ім`я" повинно містити не менше 2 символів',
            'middle_name_user.alpha' => 'Поле "По батькові" повинно містити лише алфавітні символи',
            'middle_name_user.min' => 'Поле "По батькові" повинно містити не менше 2 символів',
            'point_user.min' => 'Невірний формат номеру відділення',
        ];
    }

}
