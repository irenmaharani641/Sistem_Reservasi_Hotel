<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['booking_id', 'additional_service_id', 'quantity', 'total_price'])]
class BookingService extends Model
{
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function additionalService()
    {
        return $this->belongsTo(AdditionalService::class);
    }
}
