<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /** @use HasFactory<\Database\Factories\PromotionFactory> */
    use HasFactory;

    protected $fillable = [
        'listing_id','amount_paid','fixed_discount','percent_discount','start_date','end_date'
    ];

    public function listing() {
        return $this->belongsTo(Listing::class);
    }
}
