<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Tamus Tahir',
                'email' => 'tamus@gmail.com',
                'role' => 'ADMIN',
                'phone_number' => '081234567890',
            ],
            [
                'name' => 'Joh Doe',
                'email' => 'admin@gmail.com',
                'role' => 'ADMIN',
                'phone_number' => '081234567891',
            ],
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::factory()->create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'phone_number' => $user['phone_number'],
                ]);
            }
        }

        // Generate 10 GUEST users
        User::factory()->count(10)->create();
    }
}
