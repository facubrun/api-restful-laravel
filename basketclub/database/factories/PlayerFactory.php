<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Array player gender
     *
     * @var array
     */
    protected array $gender = ['Male', 'Female', 'Other'];
    
        /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => $this->gender[fake()->numberBetween(0, 2)],
            'date_birth' => fake()->dateTimeBetween('-50 years', '-6 years')->format('Y-m-d'),
            'user_id' => null, // This will be set when creating the player
        ];
    }
}
