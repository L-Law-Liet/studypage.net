<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ListUn extends Model
{
    protected $table = 'list_un';
    protected $fillable = ['name', 'code'];

    public static function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required'
        ];
    }
    public static function attributes()
    {
        return [
            'name' => 'Название',
            'code' => 'Код'
        ];
    }
    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }
}
