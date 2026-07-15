<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->unique()->numerify('###'),
            'type' => $this->faker->randomElement(['Standard', 'Deluxe', 'Suite']),
            'price_per_night' => $this->faker->randomFloat(2, 500000, 3000000),
            'description' => $this->faker->sentence(),
            'is_available' => $this->faker->boolean(80),
        ];
    }
}
