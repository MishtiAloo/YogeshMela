<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id','listing_id','quantity','butcher_service','delivery_service','status'
    ];

    public function buyer() {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function listing() {
        return $this->belongsTo(Listing::class);
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }

    public function butcherOrder() {
        return $this->hasOne(ButcherOrder::class);
    }
}

