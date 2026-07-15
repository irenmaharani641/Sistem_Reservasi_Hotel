<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LoyaltyPoint;
use App\Models\User;

class LoyaltyPointSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'GUEST')->first();
        if (!$user) return;

        LoyaltyPoint::create([
            'user_id' => $user->id,
            'points' => 150,
            'transaction_type' => 'EARNED',
            'description' => 'Bonus selamat datang!'
        ]);
    }
}
