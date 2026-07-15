<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Booking;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::whereIn('status', ['PENDING', 'CONFIRMED'])->get();
        
        foreach ($bookings as $booking) {
            $status = $booking->status === 'CONFIRMED' ? 'SUCCESS' : fake()->randomElement(['PENDING', 'FAILED']);
            
            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_method' => fake()->randomElement(['Credit Card', 'Transfer', 'e-Wallet']),
                'status' => $status,
                'payment_date' => $status === 'SUCCESS' ? now() : null,
            ]);
        }
    }
}
