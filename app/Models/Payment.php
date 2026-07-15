<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['booking_id', 'amount', 'payment_method', 'status', 'payment_date'])]
class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'payment_date' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    protected static function booted()
    {
        static::updated(function ($payment) {
            if ($payment->isDirty('status') && $payment->status === 'SUCCESS') {
                $payment->booking->update(['status' => 'CONFIRMED']);
            }
        });

        static::created(function ($payment) {
            if ($payment->status === 'SUCCESS') {
                $payment->booking->update(['status' => 'CONFIRMED']);
            }
        });
    }
}
