<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['url', 's_title', 's_description', 's_keywords', 'name_ru', 'name_kz', 'announce', 'description', 'image', 'active'];
}
