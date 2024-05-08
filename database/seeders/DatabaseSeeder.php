<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'yanuarfauzan',
            'email' => 'yanuarisnain017@gmail.com',
            'phone_number' => '085797227164',
            'is_verified' => true,
            'password' => Hash::make('password'),
            'gender' => true,
            'birtdate' => '17-01-02',
            'role' => 'user',
        ]);
        User::factory()->count(3)->create();
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
