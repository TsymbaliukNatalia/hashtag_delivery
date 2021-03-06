<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllPackageRequest extends FormRequest
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
            'phone_sender' => 'required|regex:/(\+380)[0-9]{9}/|size:13',
            'phone_recipient' => 'required|regex:/(\+380)[0-9]{9}/|size:13',
            'surname_sender' => 'required|alpha|min:2',
            'name_sender' => 'required|alpha|min:2',
            'middle_name_sender' => 'alpha|min:2',
            'surname_recipient' => 'required|alpha|min:2',
            'name_recipient' => 'required|alpha|min:2',
            'middle_name_recipient' => 'alpha|min:2',
            'pacckage_width' => 'required|numeric',
            'pacckage_length' => 'required|numeric',
            'pacckage_heigth' => 'required|numeric',
            'pacckage_weight' => 'required|numeric',
            'pacckage_cost' => 'required|numeric',
            'package_category' => 'required',
            // 'pay_sum' => 'required|numeric',
            // 'payer' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone_sender.required' => 'Поле "Телефон відправника" обов`язкове для заповнення',
            'phone_sender.regex' => 'Некоректний формат телефонного номеру',
            'phone_sender.size' => 'Некоректний формат телефонного номеру',
            'phone_recipient.required' => 'Поле "Телефон отримувача" обов`язкове для заповнення',
            'phone_recipient.regex' => 'Некоректний формат телефонного номеру',
            'phone_recipient.size' => 'Некоректний формат телефонного номеру',
            'surname_sender.required' => 'Поле "Прізвище відправника" обов`язкове для заповнення',
            'surname_sender.alpha' => 'Поле "Прізвище відправника" повинно містити лише алфавітні символи',
            'surname_sender.min' => 'Поле "Прізвище відправника" повинно містити не менше 2 символів',
            'name_sender.required' => 'Поле "Ім`я відправника" обов`язкове для заповнення',
            'name_sender.alpha' => 'Поле "Ім`я відправника" повинно містити лише алфавітні символи',
            'name_sender.min' => 'Поле "Ім`я відправника" повинно містити не менше 2 символів',
            'middle_name_sender.alpha' => 'Поле "По батькові відправника" повинно містити лише алфавітні символи',
            'middle_name_sender.min' => 'Поле "По батькові відправника" повинно містити не менше 2 символів',
            'surname_recipient.required' => 'Поле "Прізвище отримувача" обов`язкове для заповнення',
            'surname_recipient.alpha' => 'Поле "Прізвище отримувача" повинно містити лише алфавітні символи',
            'surname_recipient.min' => 'Поле "Прізвище отримувача" повинно містити не менше 2 символів',
            'name_recipient.required' => 'Поле "Ім`я отримувача" обов`язкове для заповнення',
            'name_recipient.alpha' => 'Поле "Ім`я отримувача" повинно містити лише алфавітні символи',
            'name_recipient.min' => 'Поле "Ім`я отримувача" повинно містити не менше 2 символів',
            'middle_name_recipient.alpha' => 'Поле "По батькові отримувача" повинно містити лише алфавітні символи',
            'middle_name_recipient.min' => 'Поле "По батькові отримувача" повинно містити не менше 2 символів',
            'pacckage_width.required' => 'Поле "Ширина" обов`язкове для заповнення',
            'pacckage_length.required' => 'Поле "Довжина" обов`язкове для заповнення',
            'pacckage_heigth.required' => 'Поле "Висота" обов`язкове для заповнення',
            'pacckage_weight.required' => 'Поле "Вага" обов`язкове для заповнення',
            'pacckage_cost.required' => 'Поле "Оціночна вартість" обов`язкове для заповнення',
            'pacckage_width.numeric' => 'Поле "Ширина" має бути числом',
            'pacckage_length.numeric' => 'Поле "Довжина" має бути числом',
            'pacckage_heigth.numeric' => 'Поле "Висота" має бути числом',
            'pacckage_weight.numeric' => 'Поле "Вага" має бути числом',
            'pacckage_cost.numeric' => 'Поле "Оціночна вартість" має бути числом',
            'package_category.required' => 'Поле "Категорія посилки:" обов`язкове для заповнення',
            // 'package_category.alpha' => 'Поле "Категорія посилки" повинно містити лише алфавітні символи',
            // 'pay_sum.required' => 'Поле "До сплати (грн):" обов`язкове для заповнення',
            // 'pay_sum.numeric' => 'Поле "До сплати (грн):" має бути числом',
            // 'payer.required' => 'Поле "Платник:" обов`язкове для вибору'
        ];
    }
    
}
