<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearnProgram extends Model
{
    public function degree()
    {
        return $this->belongsTo('App\Models\Degree');
    }
}
