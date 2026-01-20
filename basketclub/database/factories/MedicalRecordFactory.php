<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{

    protected $blood_type = ['A', 'B', 'AB', 'O'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $players = Player::all();

        return [
            'medical_public_id' => fake()->md5(),
            'blood_type' => $this->blood_type[fake()->numberBetween(0,3)],
            'allergies' => fake()->sentence(6),
            'injuries' => fake()->sentence(12),
            'player_id' => $players[fake()->numberBetween(0, $players->count() - 1)]->id,
        ];
    }
}
