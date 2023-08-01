<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => Orders::inRandomOrder()->first(),
            'product_id' => Products::inRandomOrder()->first(),
            'quantity' => fake()->numberBetween(1, 10)
        ];
    }
}
