<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmCertification>
 */
class FarmCertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $certTypes = ['Organic', 'GAP', 'Food Safety', 'Environmental'];

        return [
            'farm_owner_id' => FarmOwner::factory(),
            'certification_type' => fake()->randomElement($certTypes),
            'certification_number' => fake()->numerify('CERT-########'),
            'certification_image' => 'certifications/default.jpg',
            'issue_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'expiry_date' => fake()->dateTimeBetween('now', '+3 years'),
        ];
    }
}
