<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = 'directions';
    protected $fillable = ['url', 'name_ru', 'name_kz'];

}
