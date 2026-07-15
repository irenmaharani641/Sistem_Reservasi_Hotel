<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['room_id', 'reported_by_user_id', 'issue_description', 'status', 'resolved_at'])]
class Maintenance extends Model
{
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }

    protected static function booted()
    {
        static::saved(function ($maintenance) {
            if ($maintenance->status == 'IN_PROGRESS') {
                $maintenance->room->update(['is_available' => false]);
            } elseif ($maintenance->status == 'RESOLVED') {
                $maintenance->room->update(['is_available' => true]);
                if (is_null($maintenance->resolved_at)) {
                    $maintenance->updateQuietly(['resolved_at' => now()]);
                }
            }
        });
    }
}
