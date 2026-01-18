<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * team gender
     *
     * @var array
     */
    protected array $gender = ['Female', 'Male', 'Mixed'];
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category' => fake()->randomElement(['Infantil', 'Cadete', 'Junior', 'Senior']),
            'gender' => $this->gender[fake()->numberBetween(0, 2)],
        ];
    }
}
