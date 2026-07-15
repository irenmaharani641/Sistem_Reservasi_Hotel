<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'code' => 'WELCOME10',
            'discount_percentage' => 10.00,
            'max_discount' => 50000.00,
            'valid_until' => Carbon::now()->addMonths(3)->toDateString(),
        ]);
        
        Promotion::create([
            'code' => 'SUPER20',
            'discount_percentage' => 20.00,
            'max_discount' => 150000.00,
            'valid_until' => Carbon::now()->addMonths(1)->toDateString(),
        ]);
        
        Promotion::create([
            'code' => 'EXPIRED50',
            'discount_percentage' => 50.00,
            'max_discount' => 250000.00,
            'valid_until' => Carbon::now()->subMonths(1)->toDateString(),
        ]);
    }
}
