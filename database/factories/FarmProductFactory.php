<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FarmOwner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmProduct>
 */
class FarmProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $productTypes = ['Vegetable', 'Fruit', 'Grain', 'Livestock', 'Dairy'];
        $units = ['kg', 'piece', 'dozen', 'sack', 'head'];

        return [
            'farm_owner_id' => FarmOwner::factory(),
            'product_name' => fake()->words(2, true),
            'product_type' => fake()->randomElement($productTypes),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'unit' => fake()->randomElement($units),
            'available_quantity' => fake()->numberBetween(0, 1000),
            'product_image' => 'products/default.jpg',
            'is_available' => fake()->boolean(80),
        ];
    }
}
