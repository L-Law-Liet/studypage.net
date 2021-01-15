<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdirection extends Model
{
    protected $table = 'subdirections';
    protected $fillable = ['url', 'name_ru', 'name_kz', 'direction_id'];

    public function relDirection(){
        return $this->belongsTo(Direction::class, 'direction_id', 'id');
    }
}
