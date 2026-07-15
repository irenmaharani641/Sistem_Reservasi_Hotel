<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            RoomSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
            AdditionalServiceSeeder::class,
            BookingServiceSeeder::class,
            PromotionSeeder::class,
            MaintenanceSeeder::class,
        ]);
    }
}
