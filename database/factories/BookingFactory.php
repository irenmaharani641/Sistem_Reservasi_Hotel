<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $nights = $this->faker->numberBetween(1, 5);
        $checkOut = (clone $checkIn)->modify("+$nights days");
        
        $room = Room::inRandomOrder()->first();
        $user = User::where('role', 'GUEST')->inRandomOrder()->first();
        
        if (!$room || !$user) {
            return []; // Skip if no room or user, but seeder should ensure they exist
        }

        return [
            'user_id' => $user->id,
            'room_id' => $room->id,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'total_price' => $room->price_per_night * $nights,
            'status' => $this->faker->randomElement(['PENDING', 'CONFIRMED', 'CANCELLED']),
        ];
    }
}
