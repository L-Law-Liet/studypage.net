<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    protected $fillable = ['name', 'isCollege'];

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }
}
