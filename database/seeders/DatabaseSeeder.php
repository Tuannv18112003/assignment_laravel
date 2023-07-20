<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                BrandsSeeder::class,
                ProductsSeeder::class,
                SlidesSeeder::class,
                OrdersSeeder::class,
                ProductOrderSeeder::class,
                CouponsSeeder::class,
                ReviewsSeeder::class,
            ]
        );
        // \App\Models\User::factory(10)->create();
    }
}
