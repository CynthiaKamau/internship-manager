<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public $table = 'counties';
    public $timestamps = false;
    
    protected $fillable = [
       'name', 'status'
    ];

    public function subcounties()
    {
        return $this->hasMany('App\Models\SubCounty');
    }

    public function facilities()
    {
        return $this->hasMany('App\Models\Facility');
    }
}
