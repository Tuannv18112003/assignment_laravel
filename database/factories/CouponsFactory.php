<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupons>
 */
class CouponsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>fake()->name(),
            'code_discount' =>fake()->name(),
            'description' => fake()->paragraph(),
            'discount' => fake()->numberBetween(1, 100),
        ];
    }
}
