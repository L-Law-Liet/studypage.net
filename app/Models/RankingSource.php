<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingSource extends Model
{
    protected $table = 'ranking_source';
    protected $fillable = ['id', 'source'];
}
