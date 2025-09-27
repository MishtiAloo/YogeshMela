<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButcherOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','butcher_id','scheduled_date','charge','status'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function butcher() {
        return $this->belongsTo(User::class, 'butcher_id');
    }
}
