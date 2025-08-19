<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ParentAccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'parents_account';

    protected $fillable = [
        'parents_profile_id',
        'name',
        'username',
        'password',
        'user_role_id',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(ParentProfile::class, 'parents_profile_id', 'id');
    }


    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
