<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public $table = 'internships';

    protected $fillable = [
        'id', 'name', 'description', 'qualifications', 'responsibilities', 'validity', 'facility_id', 'duration', 'status'
    ];

    public function facility()
    {
        return $this->belongsTo('App\Models\Facility', 'facility_id');
    }

}
