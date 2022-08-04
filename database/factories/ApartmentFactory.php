<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 20),
            'name' => fake()->words(3, true),
            'price' => fake()->randomFloat(min: 350, max: 1550),
            'currency' => fake()->randomElement(['EUR', 'USD', 'BAM'])
        ];
    }
}
