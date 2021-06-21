<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityDepartment extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Facility', 'facility_id');
    }
}
