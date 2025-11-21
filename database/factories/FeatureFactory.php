<?php

namespace Database\Factories;

use App\Enums\Feature\FeatureStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(FeatureStatus::cases()),
            'type' => $this->faker->randomElement(['Feature', 'Bugfix', 'Integration']),
            'description' => $this->faker->paragraph(),
            'effort_in_days' => $this->faker->numberBetween(1, 300),
            'priority' => $this->faker->numberBetween(1, 10),
            'cost' => $this->faker->randomFloat(2, 2000, 200000),
            'target_delivery_date' => $this->faker->optional()->dateTimeBetween(startDate: now(), endDate: now()->addYear()),
            'delivered_at' => null,
        ];
    }
}
