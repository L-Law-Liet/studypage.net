<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModifyDataRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'surname' => 'required|regex:/^[\pL\s\-]+$/u',
            'birthDate' => 'required|before:2020-01-01',
            'gender' => 'required',
            'city' => 'required',
            'phone' => 'min:16',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Неверный формат имени',
            'name.regex' => 'Неверный формат имени',
            'surname.required' => 'Неверный формат фамилии',
            'surname.regex' => 'Неверный формат фамилии',
            'birthDate.required' => 'Дата рождения должна быть заполнена',
            'birthDate.before' => 'Неверный формат даты рождения',
            'gender.required' => 'Выберите пол',
            'city.required' => 'Выберите регион',
            'phone.min' => 'Неверный формат контактного телефона',
        ];
    }
}
