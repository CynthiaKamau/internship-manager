<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $table = 'departments';
    public $timestamps = false;
    
    protected $fillable = [
       'name', 'status'
    ];

    public function facilities()
    {
        return $this->belongsToMany('App\Models\Facility', 'facility_departments');
    }
}
