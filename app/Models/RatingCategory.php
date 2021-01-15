<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class RatingCategory extends Model
{
    protected $table = 'rating_categories';
    protected $fillable = ['name'];

}
