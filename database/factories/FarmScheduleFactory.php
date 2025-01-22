<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmSchedule>
 */
class FarmScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activityTypes = ['Planting', 'Harvesting', 'Maintenance', 'Training', 'Meeting'];

        return [
            'farm_owner_id' => FarmOwner::factory(),
            'activity_type' => fake()->randomElement($activityTypes),
            'description' => fake()->sentence(),
            'start_time' => fake()->dateTimeBetween('now', '+1 month'),
            'end_time' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'is_recurring' => fake()->boolean(),
            'recurrence_pattern' => fake()->optional()->randomElement(['daily', 'weekly', 'monthly'])
        ];
    }
}
