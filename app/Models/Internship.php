<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public $table = 'internships';

    protected $fillable = [
        'id', 'name', 'description'
    ];
}
