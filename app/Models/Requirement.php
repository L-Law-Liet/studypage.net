<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';
    protected $fillable = ['degree_id', 'content_ru', 'content_kz'];

    public function relDegree(){
        return $this->belongsTo(Degree::class, 'degree_id');
    }
}
