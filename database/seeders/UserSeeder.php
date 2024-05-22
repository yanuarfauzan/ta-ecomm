<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'yanuarisnain',
            'email' => 'yanuarisnain017@gmail.com',
            'phone_number' => '085797227164',
            'is_verified' => 1,
            'password'=> Hash::make('@Password17'),
            'gender' => 1,
            'birtdate' => '2002-01-17',
            'profile_image' => 'userProfile.jpg',
            'role' => 'user',
        ]);

        $user->userAddresses()->create([
            'detail' => 'Kost Poniran',
            'postal_code' => '46361',
            'address' => '6CV8+723, Jetis, Condongcatur, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584',
            'city' => 'Yogyakarta',
            'province' => 'DI Yogyakarta',
            'is_default' => 1
        ]);

        $operator = User::create([
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'phone_number' => '085797227164',
            'is_verified' => 1,
            'password'=> Hash::make('@Password17'),
            'gender' => 1,
            'birtdate' => '2002-01-18',
            'profile_image' => 'operatorProfile.jpg',
            'role' => 'operator',
        ]);

        $operator->userAddresses()->create([
            'detail' => 'Rumah Ijo',
            'postal_code' => '46321',
            'address' => 'Jl. Setia Budi Tengah No.29 2, RT.2/RW.3, Kuningan, Setia Budi, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12910',
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
            'is_default' => 1
        ]);
    }
}
