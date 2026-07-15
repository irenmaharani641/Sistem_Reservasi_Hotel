<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['room_number', 'type', 'price_per_night', 'description', 'is_available'])]
class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
