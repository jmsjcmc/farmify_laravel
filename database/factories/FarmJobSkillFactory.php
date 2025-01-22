<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmJob;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmJobSkill>
 */
class FarmJobSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = ['Farming', 'Harvesting', 'Equipment Operation', 'Pest Control', 'Irrigation', 'Animal Care'];
        $levels = ['Beginner', 'Intermediate', 'Advanced'];

        return [
            'farm_job_id' => FarmJob::factory(),
            'skill_name' => fake()->randomElement($skills),
            'skill_level' => fake()->randomElement($levels),
        ];
    }
}
