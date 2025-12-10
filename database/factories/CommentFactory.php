<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->paragraph(),
            'user_id' => \App\Models\User::factory(),
            'feature_id' => \App\Models\Feature::factory(),
            'is_approved' => $this->faker->boolean(70), // 70% chance of being approved
        ];
    }
}
