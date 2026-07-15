<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Booking;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::where('status', 'CONFIRMED')->get();
        
        foreach ($bookings as $booking) {
            Review::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'room_id' => $booking->room_id,
                'rating' => fake()->numberBetween(3, 5),
                'comment' => fake()->sentence(),
            ]);
        }
    }
}
