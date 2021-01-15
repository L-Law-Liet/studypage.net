<?php

namespace App\Models;

use App\ProfileUniversity;
use App\Region;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';
    protected $fillable = ['name_ru', 'name_kz', 'code', 'subdivision', 'logo', 'state_id', 'city_id', 'region_id', 'address_ru', 'address_kz', 'phone', 'postcode', 'email', 'web_site', 'type_id', 'user_id', 'hasCollege'];

    public function relCity(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function relRegion(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    public function relType(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    public function grantS()
    {
        return $this->hasMany('App\GrantsDiscounts');
    }
    public function programs()
    {
        return $this->hasMany('App\LearnProgram');
    }
}
