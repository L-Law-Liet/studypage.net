<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationForm extends Model
{
    protected $table = 'education_forms';
    protected $fillable = ['name'];
}
