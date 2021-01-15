<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CostEducation extends Model
{
    protected $table = 'cost_education';
    protected $fillable = ['university_id', 'specialty_id', 'language_id', 'price', 'rating', 'year', 'total', 'number_grants_ru', 'number_grants_kz', 'passing_score_ru', 'passing_score_kz', 'passing_score', 'source'];

    public function relUniversity(){
        return $this->belongsTo(University::class, 'university_id', 'id');
    }

    public function relSpecialty(){
        return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
    }
    public function degree(){
        return $this->belongsTo(Degree::class, 'degree_id', 'id');
    }

    public function relLanguage(){
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public static function getRating($specialty_id){
        return CostEducation::select(DB::raw('cost_education.*, total'))
            ->where('specialty_id', $specialty_id)->whereNotNull('total')
            ->orderBy('total', 'ASC')->get(); //CAST(total AS int) AS total - преобразование типов
    }

    public static function filter($cost, $data){
        foreach ($data as $k => $v) {
            if($v === null || $v === '')
                continue;

            $cost->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
            if($k == 'university_id'){
                $cost->where($k, trim($v));
            }
            if($k == 'degree_id'){
                $cost->where('specialties.degree_id', $v);
            }
            if($k == 'cipher'){
                $cost->where('specialties.cipher', 'LIKE', "%".trim($v)."%");
            } else
                $cost->where($k, 'LIKE', "%".trim($v)."%");
        }
        return $cost;
    }
}
