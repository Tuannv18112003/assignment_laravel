<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'star' => fake()->numberBetween(1, 5),
            'comment' => fake()->text(),
            'user_id' => User::inRandomOrder()->first(),
            'product_id' => Products::inRandomOrder()->first(),
        ];
    }
}
