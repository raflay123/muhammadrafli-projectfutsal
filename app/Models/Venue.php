<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'location',
        'price_per_hour',
        'image',
        'is_available',
        'open_time',
        'close_time'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}