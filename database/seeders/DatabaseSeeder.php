<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Database\Seeders\VoucherSeeder;
use Database\Seeders\ProductAssessmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProvinciesAndCitiesSeeder::class,
            VoucherSeeder::class
        ]);
        
        User::factory()->count(1)->create();
        Category::factory()->count(5)->create();
        Variation::factory()->count(10)->create();
        Product::factory()->count(5)->create();

        $this->call([
            ProductAssessmentSeeder::class,
        ]);

        // Notification::create([
        //     'content' => 'Selamat Datang!'
        // ]);
        // Notification::create([
        //     'content' => 'Selamat!, Pesanan Anda Sedang'
        // ]);
    }
}
