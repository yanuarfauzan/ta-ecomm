<?php

namespace Database\Factories;

use App\Models\Variation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(36),
            'name' => fake()->unique()->word(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Variation $variation) {
            $numberOfOptions = 6; // Ubah sesuai kebutuhan
            for ($i = 0; $i < $numberOfOptions; $i++) {
                $variation->variationOption()->create([
                    'name' => fake()->unique()->word(),
                ]);
            }
        });
    }
}
