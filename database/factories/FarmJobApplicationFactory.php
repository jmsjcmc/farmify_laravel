<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmJob;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmJobApplication>
 */
class FarmJobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['Pending', 'Shortlisted', 'Interviewed', 'Offered', 'Hired', 'Rejected'];

        return [
            'farm_job_id' => FarmJob::factory(),
            'user_id' => User::factory(),
            'cover_letter' => fake()->paragraphs(3, true),
            'resume_path' => 'resumes/default.pdf',
            'status' => fake()->randomElement($statuses),
            'notes' => fake()->optional()->paragraph(),
            'interview_date' => fake()->optional()->dateTimeBetween('now', '+2 weeks'),
            'offered_salary' => fake()->optional()->numberBetween(300, 3000),
            'offered_salary_type' => fake()->optional()->randomElement(['Per Hour', 'Per Day', 'Per Month']),
            'hiring_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'rejection_reason' => fake()->optional()->sentence(),
        ];
    }
}
