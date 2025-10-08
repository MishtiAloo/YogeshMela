<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','animal_type','breed','age','weight','price',
        'location','vaccination_info','status'
    ];

    public function seller() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function promotions() {
        return $this->hasMany(Promotion::class);
    }
}

