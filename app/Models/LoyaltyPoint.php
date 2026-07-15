<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'points', 'transaction_type', 'description'])]
class LoyaltyPoint extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
