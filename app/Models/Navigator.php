<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigator extends Model
{
    protected $table = 'navigator';
    protected $fillable = ['s_title', 's_description', 's_keywords', 'name_ru', 'name_kz', 'announce', 'description', 'image', 'active'];
}
