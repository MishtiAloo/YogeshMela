<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
        'house_no', 'road_no', 'thana', 'postal_code', 'city', 'division',
        'role', 'verified',
    ];

    protected $hidden = [
        'password'
    ];
}
