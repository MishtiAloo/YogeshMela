<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','delivery_man_id','delivery_date','delivery_address','charge','status'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function deliveryMan() {
        return $this->belongsTo(User::class, 'delivery_man_id');
    }
}

