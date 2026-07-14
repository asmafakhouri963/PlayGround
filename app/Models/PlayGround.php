<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayGround extends Model
{
    protected $fillable= [
        "location",
        "city",
        "type",
        "image",
        "hourPrice",
        "hourWork",
        "minHours",
        "maxHours"
        ];
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
