<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['code', 'discount_percentage', 'max_discount', 'valid_until'])]
class Promotion extends Model
{
    /** @use HasFactory<\Database\Factories\PromotionFactory> */
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
