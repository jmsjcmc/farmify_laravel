<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmJob>
 */
class FarmJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobTypes = ['Full-Time', 'Part-Time', 'Contract', 'Seasonal']; // Changed to match migration case
        $employmentTypes = ['Permanent', 'Temporary', 'Seasonal'];
        $statuses = ['Draft', 'Active', 'Closed'];

        return [
            'farm_owner_id' => FarmOwner::factory(),
            'title' => fake()->jobTitle(),
            'job_type' => fake()->randomElement($jobTypes), // This will now match the enum
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'responsibilities' => fake()->paragraphs(2, true),
            'salary_from' => fake()->numberBetween(300, 1000),
            'salary_to' => fake()->numberBetween(1001, 3000),
            'salary_type' => fake()->randomElement(['Per Hour', 'Per Day', 'Per Month']),
            'vacancies' => fake()->numberBetween(1, 10),
            'employment_type' => fake()->randomElement($employmentTypes),
            'start_date' => fake()->dateTimeBetween('now', '+1 month'),
            'end_date' => fake()->dateTimeBetween('+1 month', '+6 months'),
            'location' => fake()->city(),
            'benefits' => fake()->paragraph(),
            'status' => fake()->randomElement($statuses),
        ];
    }
}
