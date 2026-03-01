<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'email',
            'password',
            'is_active',
        ];

    protected $hidden =
        [
            'password',
        ];

    protected $casts =
        [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
}
