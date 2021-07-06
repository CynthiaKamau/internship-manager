<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    
    protected $fillable = [
        'user_id', 'approved_by', 'lat', 'long', 'facility_id', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
