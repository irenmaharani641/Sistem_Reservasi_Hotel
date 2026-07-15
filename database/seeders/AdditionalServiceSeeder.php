<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AdditionalService;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Breakfast (Sarapan Pagi)', 'description' => 'Paket sarapan prasmanan sepuasnya untuk 1 orang.', 'price' => 150000],
            ['name' => 'Extra Bed', 'description' => 'Kasur lipat tambahan ukuran single bed dengan bantal dan selimut.', 'price' => 250000],
            ['name' => 'Airport Transfer (Antar Jemput Bandara)', 'description' => 'Layanan penjemputan dari dan ke bandara secara eksklusif.', 'price' => 300000],
            ['name' => 'Spa & Massage (Pijat Relaksasi)', 'description' => 'Layanan pijat seluruh tubuh durasi 60 menit oleh terapis bersertifikat.', 'price' => 350000],
            ['name' => 'Laundry (Cuci Pakaian)', 'description' => 'Layanan cuci pakaian kilat per 1 kilogram.', 'price' => 50000],
        ];

        foreach ($services as $service) {
            AdditionalService::create($service);
        }
    }
}
