<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        "code",
        "discount"
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}