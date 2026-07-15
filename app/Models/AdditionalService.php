<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'description', 'price'])]
class AdditionalService extends Model
{
    /** @use HasFactory<\Database\Factories\AdditionalServiceFactory> */
    use HasFactory;

    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
}
