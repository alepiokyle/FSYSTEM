<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department',
        'subject_name',
        'subject_code',
        'units',
        'year_level',
        'semester',
        'school_year',
    ];
}
