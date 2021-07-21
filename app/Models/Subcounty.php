<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    public $table = 'sub_county';
    public $timestamps = false;
    
    protected $fillable = [
       'name', 'status', 'county_id'
    ];

    public function county()
    {
        return $this->belongsTo('App\Models\County');
    }
}
