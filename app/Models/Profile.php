<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'username', 'user_id', 'reg_number', 'index_number', 'id_number', 'gender', 'dob', 'citizenship', 'address', 'profile_photo', 'facility_id', 'cadre_id', 'department_id', 'licence_id', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function facility()
    {
        return $this->belongsTo('App\Models\Facility', 'facility_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
}
