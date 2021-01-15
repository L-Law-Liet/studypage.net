<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parner extends Model
{
    protected $table = 'partners';
    protected $fillable = ['name', 'region', 'link', 'image'];
}
