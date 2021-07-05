<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'username', 'reg_number', 'index_number', 'id_number', 'gender', 'dob', 'citizanship', 'address', 'profile_photo', 'facility_id', 'cadre_id', 'department_id', 'licence_id', 'created-at'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
