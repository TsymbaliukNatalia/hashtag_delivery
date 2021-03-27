<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostParamsRequest extends FormRequest
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
            'width' => 'required|numeric',
            'length' => 'required|numeric',
            'heigth' => 'required|numeric',
            'weight' => 'required|numeric',
            'cost' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'width.required' => 'Поле "Ширина" обов`язкове для заповнення',
            'length.required' => 'Поле "Довжина" обов`язкове для заповнення',
            'heigth.required' => 'Поле "Висота" обов`язкове для заповнення',
            'weight.required' => 'Поле "Вага" обов`язкове для заповнення',
            'cost.required' => 'Поле "Оціночна вартість" обов`язкове для заповнення',
            'width.numeric' => 'Поле "Ширина" має бути числом',
            'length.numeric' => 'Поле "Довжина" має бути числом',
            'heigth.numeric' => 'Поле "Висота" має бути числом',
            'weight.numeric' => 'Поле "Вага" має бути числом',
            'cost.numeric' => 'Поле "Оціночна вартість" має бути числом',
        ];
    }
    
}
