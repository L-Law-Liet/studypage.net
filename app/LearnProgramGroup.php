<?php

namespace App;

use App\Models\Degree;
use App\Models\Subdirection;
use Illuminate\Database\Eloquent\Model;

class LearnProgramGroup extends Model
{    protected $table = 'learn_program_groups';
    protected $fillable = ['name_ru', 'subdirection_id', 'language_id', 'degree_id', 'passing_score_kz', 'passing_score_ru', 'paid_score'];

    public function relSubdirection(){
        return $this->belongsTo(Subdirection::class, 'subdirection_id', 'id');
    }
    public function relDegree()
    {
        return $this->belongsTo(Degree::class, 'degree_id', 'id');
    }
}
