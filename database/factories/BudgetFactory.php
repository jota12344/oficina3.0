<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client' => $this->faker->name(),
            'budget_datetime' => $this->faker->dateTimeThisMonth(),
            'estimated_value' => $this->faker->randomFloat(2, 100, 5000),
            'seller' => $this->faker->name(),
            'description' => $this->faker->sentence(6),
        ];
    }
}
