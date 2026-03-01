<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskEntryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'actual_value' => fake()->numberBetween(0, 10),
        ];
    }
}
