<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Callback extends Model
{
    protected $table = 'callback';
    protected $fillable = ['name', 'email', 'phone', 'question', 'answer'];

    public static function rules()
    {
        return [
            'firstName' => 'required',
            'footerEmail' => 'required|email',
            'footerPhone' => 'required|min:16',
            'question' => 'required',
        ];
    }

    public static function attributes()
    {
        return [
            'firstName' => 'имя',
            'footerEmail' => 'электронная почта',
            'footerPhone' => 'телефон',
            'question' => 'сообщение',
        ];
    }

    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }
}
