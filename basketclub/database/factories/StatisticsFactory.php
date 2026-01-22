<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistics>
 */
class StatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $players = Player::all();

        return [
            'games_played' => $this->faker->numberBetween(0, 82),
            'threes_made' => $this->faker->numberBetween(0, 300),
            'doubles_made' => $this->faker->numberBetween(0, 500),
            'free_throws_made' => $this->faker->numberBetween(0, 200),
            'points_scored' => $this->faker->numberBetween(0, 2000),
            'player_id' => $players[fake()->numberBetween(0, $players->count() - 1)]->id,
        ];
    }
}
