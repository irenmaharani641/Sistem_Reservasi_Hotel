<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Booking;
use App\Models\AdditionalService;
use App\Models\BookingService;

class BookingServiceSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::inRandomOrder()->take(5)->get();
        $services = AdditionalService::all();

        if ($services->isEmpty()) return;

        foreach ($bookings as $booking) {
            $randomServices = $services->random(rand(1, 3));
            
            $additionalTotal = 0;
            foreach ($randomServices as $service) {
                $qty = rand(1, 2);
                $totalPrice = $service->price * $qty;
                
                BookingService::create([
                    'booking_id' => $booking->id,
                    'additional_service_id' => $service->id,
                    'quantity' => $qty,
                    'total_price' => $totalPrice
                ]);
                
                $additionalTotal += $totalPrice;
            }
            
            $booking->update([
                'total_price' => $booking->total_price + $additionalTotal
            ]);
        }
    }
}
