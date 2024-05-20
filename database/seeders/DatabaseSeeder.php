<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'username' => 'yanuarfauzan',
        //     'email' => 'yanuarisnain017@gmail.com',
        //     'phone_number' => '085797227164',
        //     'is_verified' => true,
        //     'password' => Hash::make('@Koromod17'),
        //     'gender' => true,
        //     'birtdate' => '17-01-02',
        //     'role' => 'user',
        // ]);
        
        User::factory()->count(1)->create();
        Category::factory()->count(14)->create();
        Variation::factory()->count(10)->create();
        Product::factory()->count(16)->create();

        Notification::create([
            'content' => 'Selamat Datang!'
        ]);
        Notification::create([
            'content' => 'Selamat!, Pesanan Anda Sedang'
        ]);
    }
}
