<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Milestone>
 */
class MilestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Fake()->sentence(),
            'description' => Fake()->sentences(4, true),
            'deadline' => Fake()->dateTimeBetween('today', '+2years')->format('Y-m-d')
        ];
    }
}
