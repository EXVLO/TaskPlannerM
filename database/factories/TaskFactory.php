<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'daily_target' => fake()->numberBetween(1, 10),
            'is_active' => fake()->boolean(90),
        ];
    }
}
