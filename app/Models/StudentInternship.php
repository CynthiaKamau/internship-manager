<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInternship extends Model
{
    public $table = 'student_internship';

    protected $fillable = [
        'id', 'student_id', 'supervisor_id', 'internship_id'
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Models\User', 'supervisor_id');
    }

    public function internship()
    {
        return $this->belongsTo('App\Models\Internship', 'internship_id');
    }
}
