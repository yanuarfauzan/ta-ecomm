<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinciesAndCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'key' => env('API_KEY_RAJAONGKIR')
        ])->get(env('API_BASE_URL_RAJA_ONGKIR') . '/city');
        collect($response->json()['rajaongkir']['results'])->each(function ($result) {
            ProvinciesAndCities::create([
                'city_id' => $result['city_id'],
                'province_id' => $result['province_id'],
                'city_name' => $result['city_name'],
                'province' => $result['province'],
                'type' => $result['type'],
                'postal_code' => $result['postal_code']
            ]);
        });
    }
}
