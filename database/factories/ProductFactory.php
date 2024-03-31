<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'SKU' => fake()->bothify('SKU-????-####'),
            'stock' => fake()->numberBetween(0, 1000),
            'product_image' => fake()->image('storage/app/public/product_pictures', 400, 400, 'product', false),
            'price' => fake()->randomFloat(2, 100, 1000),
            'desc' => fake()->sentence()
        ];
    }
}
