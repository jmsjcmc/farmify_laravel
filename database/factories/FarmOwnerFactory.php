<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmOwner>
 */
class FarmOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $farmTypes = ['Crop', 'Livestock', 'Mixed', 'Poultry', 'Aquaculture'];
        $statuses = ['Pending', 'Approved', 'Rejected'];

        return [
            'user_id' => User::factory(),
            'farm_name' => fake()->company() . ' Farms',
            'farm_address' => fake()->address(),
            'farm_size' => fake()->numberBetween(1, 1000) . ' hectares',
            'farm_type' => fake()->randomElement($farmTypes),
            'contact_number' => fake()->phoneNumber(),
            'farm_description' => fake()->paragraph(),
            'business_permit_number' => fake()->numerify('BP-########'),
            'business_permit_image' => 'permits/default.jpg',
            'valid_id_type' => fake()->randomElement(['Passport', 'Driver\'s License', 'National ID']),
            'valid_id_number' => fake()->numerify('ID########'),
            'valid_id_image' => 'ids/default.jpg',
            'status' => fake()->randomElement($statuses),
            'rejection_reason' => null,
            'approved_at' => now(),
            'approved_by' => null,
        ];
    }
}
