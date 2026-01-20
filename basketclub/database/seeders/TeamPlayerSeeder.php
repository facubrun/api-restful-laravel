<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los teams y players
        $teams = Team::all();
        $players = Player::all();

        // Asignar jugadores a equipos aleatoriamente
        foreach ($teams as $team) {
            // Asignar 8 jugadores aleatorios a cada equipo
            $team->players()->attach(
                $players->random(8)->pluck('id')->toArray()
            );
        }
    }
}
