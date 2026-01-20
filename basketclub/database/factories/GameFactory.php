<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teams = Team::all();
        return [
            'is_home' => fake()->boolean(),
            'pts_team' => fake()->numberBetween(50, 120),
            'pts_opponent' => fake()->numberBetween(50, 120),
            'game_date' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s'),
            'opponent_name' => fake()->company(),
            'team_id' => $teams[fake()->numberBetween(0, $teams->count() - 1)]->id,
        ];
    }
}
