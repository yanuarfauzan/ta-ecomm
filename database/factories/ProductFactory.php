<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Support\Str;
use App\Models\ProductVoucher;
use App\Models\ProductCategoryVariation;
use App\Models\ProductCategoryVariationDetail;
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
            'desc' => fake()->paragraph(),
            'rate' => fake()->numberBetween(1, 5),
            'stock' => fake()->numberBetween(0, 1000),
            'price' => fake()->numberBetween(10, 1000) * 1000,
            'dimensions' => fake()->numberBetween(1, 100) . 'x' . fake()->numberBetween(1, 100),
            'weight' => round(fake()->numberBetween(100, 10000) / 1000, 2),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            for ($i = 0; $i < 5; $i++) {
                $product->hasImages()->create([
                    'id' => Str::uuid(36),
                    'filepath_image' => fake()->image('storage/app/public/product-images', 400, 400, 'product', false),
                ]);
            }
            $voucher = Voucher::all();
            ProductVoucher::create([
                'id' => Str::uuid(36),
                'product_id' => $product->id,
                'voucher_id' => $voucher[0]->id
            ]);
            ProductVoucher::create([
                'id' => Str::uuid(36),
                'product_id' => $product->id,
                'voucher_id' => $voucher[1]->id
            ]);
            $category = Category::inRandomOrder()->first();
            $variations = Variation::inRandomOrder()->limit(2)->get();
            foreach ($variations as $variation) {
                $product->variation()->attach(
                    $variation->id,
                    [
                        'id' => Str::uuid(36),
                        'category_id' => $category->id,
                    ]
                );
                $productImages = $product->hasImages()->get();
                $variationOptions = $variation->variationOption;

                foreach ($variationOptions as $varOption) {
                    $productImage = $productImages->shift();
                    if ($productImage) {
                        $varOption->update([
                            'product_image_id' => $productImage->id,
                            'stock' => fake()->numberBetween(0, 1000),
                            'price' => fake()->numberBetween(10, 1000) * 1000,
                            'dimensions' => fake()->numberBetween(1, 100) . 'x' . fake()->numberBetween(1, 100),
                            'weight' => round(fake()->numberBetween(100, 10000) / 1000, 2),
                        ]);
                    }
                }
            }
        });
    }
}
