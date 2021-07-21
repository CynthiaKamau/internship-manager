<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSummary extends Model
{
    public $table = 'users_summary';
    public $timestamps = false;

    protected $fillable = [
        'id', 'role', 'county_id', 'sub_county_id', 'gender', 'facility_id', 'created_at'
    ];
}
