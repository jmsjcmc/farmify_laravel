<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmImage>
 */
class FarmImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farm_owner_id' => FarmOwner::factory(),
            'image_path' => 'farms/default.jpg',
            'caption' => fake()->sentence(),
        ];
    }
}
