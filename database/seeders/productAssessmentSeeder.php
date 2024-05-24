<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\ProductAssessment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class productAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 5,
            'content' => 'kualitas produk nya bagus banget',
            'response_operator' => 'makasih orang baik',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 4,
            'content' => 'pengiriman nya sangat cepat',
            'response_operator' => 'makasih ya bang',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 3,
            'content' => 'sesuai deskripsi',
            'response_operator' => 'oh pasti dong kita kan amanah',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 4,
            'content' => 'kemasan nya aman',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 5,
            'content' => 'pelayanan nya ramah',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 5,
            'content' => 'harga nya ramah buat anak kos',
            'response_operator' => 'itumah pasti',
            'created_at' => Carbon::now(),
        ]);
        ProductAssessment::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::first()->id,
            'rating' => 3,
            'content' => 'wah mantap',
            'response_operator' => 'hehe',
            'created_at' => Carbon::now(),
        ]);
    }
}
