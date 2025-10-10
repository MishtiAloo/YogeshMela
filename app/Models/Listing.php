<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','animal_type','breed','age','weight','price',
        'location','vaccination_info','status','image'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Alias for backward compatibility
    public function seller() {
        return $this->user();
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function promotions() {
        return $this->hasMany(Promotion::class);
    }
}

