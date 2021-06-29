<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityDepartment extends Model
{
    public $table = 'facility_departments';
    public $timestamps = false;
    
    protected $fillable = [
       'facility_id', 'department_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Models\Facility', 'facility_id');
    }
}
