<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Proposal extends Model
{
    protected $table = 'proposal';
    protected $fillable = ['email', 'contact_phone', 'university_name', 'contact_name'];

    public static function rules()
    {
        return [
            'footerEmail' => 'required|email',
            'contact_phone' => 'required|min:16',
            'university_name' => 'required',
            'contact_name' => 'required',
        ];
    }

    public static function attributes()
    {
        return [
            'footerEmail' => 'электронная почта',
            'contact_phone' => 'контактный телефон',
            'university_name' => 'название учебного заведения',
            'contact_name' => 'имя контактного лица',
        ];
    }

    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }
}
