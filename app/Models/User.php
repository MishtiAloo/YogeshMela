<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'house_no', 'road_no', 'thana', 'postal_code', 'city', 'division',
        'role', 'verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
