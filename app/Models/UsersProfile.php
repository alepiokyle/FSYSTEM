<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    protected $table = 'users_profile';

    protected $fillable = [
        'users_id',
        'parents_profile_id',
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'date_of_birth',
        'gender',
        'course',
        'year_level',
        'parents_profile_id', // kung gusto mo i-link sa parent
    ];

    // 🔹 Profile belongs to a Student
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // 🔹 Profile may have Parent
    public function parent()
    {
        return $this->belongsTo(ParentProfile::class, 'parents_profile_id', 'id');
    }
}
