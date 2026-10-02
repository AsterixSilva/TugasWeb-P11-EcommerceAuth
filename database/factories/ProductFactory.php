<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->sentence(10),
            'price' => fake()->numberBetween(50000, 15000000),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}