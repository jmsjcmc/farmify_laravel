<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmFacility>
 */
class FarmFacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $facilityTypes = ['Storage', 'Processing', 'Equipment', 'Housing', 'Irrigation'];

        return [
            'farm_owner_id' => FarmOwner::factory(),
            'facility_name' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'facility_type' => fake()->randomElement($facilityTypes),
            'capacity' => fake()->numberBetween(100, 1000),
            'facility_image' => 'facilities/default.jpg',
            'is_operational' => fake()->boolean(80),
        ];
    }
}
