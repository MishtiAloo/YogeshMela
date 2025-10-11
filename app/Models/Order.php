<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id','listing_id','quantity','total_price','additional_services_fee','butcher_service','delivery_service','delivery_address','phone','payment_method','notes','status'
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

