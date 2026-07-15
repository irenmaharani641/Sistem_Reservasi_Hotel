<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Maintenance;
use App\Models\Room;
use App\Models\User;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = Room::take(3)->get();
        $user = User::where('role', 'GUEST')->first();

        if ($rooms->count() < 3 || !$user) return;

        Maintenance::create([
            'room_id' => $rooms[0]->id,
            'reported_by_user_id' => $user->id,
            'issue_description' => 'AC bocor dan kurang dingin.',
            'status' => 'PENDING'
        ]);

        Maintenance::create([
            'room_id' => $rooms[1]->id,
            'reported_by_user_id' => $user->id,
            'issue_description' => 'Saluran air wastafel mampet.',
            'status' => 'IN_PROGRESS'
        ]);

        Maintenance::create([
            'room_id' => $rooms[2]->id,
            'reported_by_user_id' => $user->id,
            'issue_description' => 'Lampu kamar mandi mati.',
            'status' => 'RESOLVED'
        ]);
    }
}
