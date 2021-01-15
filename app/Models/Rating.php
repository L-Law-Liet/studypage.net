<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Rating extends Model
{
    protected $table = 'rating';
    protected $fillable = ['category_id', 'university_id', 'city_id', 'overall_rating'];

    public static function rules()
    {
        return [
            'profile_id' => 'required',
            'university_id' => 'required',
//            'city_id' => 'required',
            'rating' => 'required',
        ];
    }

    public static function attributes()
    {
        return [
            'profile_id' => 'Направление',
            'university_id' => 'Университет',
//            'city_id' => 'Город',
            'rating' => 'Итого',
        ];
    }

    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }

    public function relCategory(){
        return $this->belongsTo(RatingCategory::class, 'category_id');
    }

    public function relUniversity(){
        return $this->belongsTo(University::class, 'university_id');
    }

    public function relCity(){
        return $this->belongsTo(City::class, 'city_id');
    }

}
