<?php

namespace App;

use App\Models\University;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileUniversity extends Pivot
{
    protected $table = 'profile_university';
    protected $fillable = ['profile_id', 'university_id', 'rating'];

    public function relUniversity(){
        return $this->belongsTo(University::class, 'university_id');
    }
    public function relProfile(){
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
