<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';
    public $timestamps = false;
    
    protected $fillable = [
       'name', 'status'
    ];

    public function users() 
    {

        return $this->belongsTo('App\Models\Country');
    }
}
