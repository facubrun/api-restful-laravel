<?php

namespace Database\Seeders;

use App\Models\Coacher;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CoachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 10 entrenadores
        $coachers = Coacher::factory(10)->create();

        // Obtener todos los equipos
        $teams = Team::all();

        if ($teams->count() > 0) {
            // Asignar entrenadores a equipos de forma aleatoria
            foreach ($coachers as $coacher) {
                // Cada entrenador puede entrenar entre 1 y 3 equipos
                $randomTeams = $teams->random(rand(1, min(3, $teams->count())));
                
                foreach ($randomTeams as $team) {
                    $coacher->teams()->attach($team->id, [
                        'start_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                        'end_date' => fake()->boolean(70) ? null : fake()->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
                    ]);
                }
            }
        }
    }
}
