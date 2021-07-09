<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public $table = 'facilities';
    public $timestamps = false;
    
    protected $fillable = [
       'id', 'code', 'name', 'keph_level', 'facility_type', 'county', 'sub_county', 'active',
    ];

    public function departments()
    {
        return $this->belongsToMany('App\Models\Department', 'facility_departments');
    }

    public function checkins()
    {
        return $this->hasMany('App\Models\Checkin');
    }
}
