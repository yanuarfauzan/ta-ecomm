<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Str;
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
            'price' => fake()->randomFloat(2, 100, 1000),
            'desc' => fake()->sentence()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            for ($i = 0; $i < 5; $i++) {
                $product->hasImages()->create([
                    'id' => Str::uuid(36),
                    'filepath_image' => fake()->image('storage/app/public/product_pictures', 400, 400, 'product', false),
                ]);
            }
            $category = Category::inRandomOrder()->first();
            $variations = Variation::inRandomOrder()->limit(2)->get();
            foreach ($variations as $variation) {
                $product->variation()->attach($variation->id, ['id' => Str::uuid(36), 'category_id' => $category->id]);
                $productImages = $product->hasImages()->get();
                $variationOptions = $variation->variationOption;

                foreach ($variationOptions as $varOption) {
                    $productImage = $productImages->shift();
                    if ($productImage) {
                        $varOption->update([
                            'product_image_id' => $productImage->id
                        ]);
                    }
                }
            }

        });
    }
}
