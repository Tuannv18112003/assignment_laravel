<?php

namespace Database\Factories;
use App\Models\Brands;
use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $faker = Faker::create();
        
        return [
            'product_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'price' => fake()->numberBetween(1000, 10000),
            'brand_id' => Brands::inRandomOrder()->first()
            
        ];
    }
}
