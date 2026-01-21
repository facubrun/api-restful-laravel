<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Asignar un jugador a cada usuario
        foreach ($users as $user) {
            Player::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
