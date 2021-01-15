<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'newPassword' => 'required|string|min:8',
            'newPassword_confirmation' => 'required|same:newPassword',
        ];
    }
    public function messages()
    {
        return [
            'newPassword.string' => 'Заполните пожалуйста поле',
            'newPassword.min' => 'Поле должно иметь минимум 8 символов.',
            'newPassword.required' => 'Заполните пожалуйста поле',
            'newPassword_confirmation.same' => 'Пароль и его подтверждение не совпадают.',
            'newPassword_confirmation.required' => 'Заполните пожалуйста поле',
        ];
    }
}
