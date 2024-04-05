<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();
        Category::factory()->count(5)->create();
        Product::factory()->count(5)->create();

        Notification::create([
            'content' => 'Selamat Datang!'
        ]);
        Notification::create([
            'content' => 'Selamat!, Pesanan Anda Sedang'
        ]);
    }
}
