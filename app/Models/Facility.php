<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public $table = 'facilities';
    public $timestamps = false;
    
    protected $fillable = [
       'Code', 'Name', 'Keph_level', 'Facility_type', 'County', 'Sub_county', 'Active',
    ];
}
