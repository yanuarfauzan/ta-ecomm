<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Elektronik',
            'icon' => 'icon-category/elektronik.png'
        ]);
        Category::create([
            'name' => 'Komputer',
            'icon' => 'icon-category/komputer.png'
        ]);
        Category::create([
            'name' => 'Handphone',
            'icon' => 'icon-category/handphone.png'
        ]);
        Category::create([
            'name' => 'Pakaian Pria',
            'icon' => 'icon-category/pakaian_pria.png'
        ]);
        Category::create([
            'name' => 'Pakaian Wanita',
            'icon' => 'icon-category/pakaian_wanita.png'
        ]);
        Category::create([
            'name' => 'Sepatu Pria',
            'icon' => 'icon-category/sepatu.png'
        ]);
        Category::create([
            'name' => 'Sepatu Wanita',
            'icon' => 'icon-category/sepatu_wanita.png'
        ]);
        Category::create([
            'name' => 'Tas Wanita',
            'icon' => 'icon-category/tas_wanita.png'
        ]);
        Category::create([
            'name' => 'Tas Pria',
            'icon' => 'icon-category/tas.png'
        ]);
        Category::create([
            'name' => 'Pakaian Muslim',
            'icon' => 'icon-category/pakaian_muslim.png'
        ]);
        Category::create([
            'name' => 'Pakaian Bayi',
            'icon' => 'icon-category/pakaian_bayi.png'
        ]);
        Category::create([
            'name' => 'Aksesoris',
            'icon' => 'icon-category/aksesoris.png'
        ]);
        Category::create([
            'name' => 'Makanan',
            'icon' => 'icon-category/makanan.png'
        ]);
        Category::create([
            'name' => 'Otomotif',
            'icon' => 'icon-category/otomotif.png'
        ]);
        Category::create([
            'name' => 'Hobi',
            'icon' => 'icon-category/hobi.png'
        ]);
        Category::create([
            'name' => 'Jam Tangan',
            'icon' => 'icon-category/jam_tangan.png'
        ]);
        Category::create([
            'name' => 'Kesehatan',
            'icon' => 'icon-category/kesehatan.png'
        ]);
        Category::create([
            'name' => 'Keperawatan',
            'icon' => 'icon-category/keperawatan.png'
        ]);
        Category::create([
            'name' => 'Olahraga',
            'icon' => 'icon-category/olahraga.png'
        ]);
        Category::create([
            'name' => 'Kamera',
            'icon' => 'icon-category/kamera.png'
        ]);
        Category::create([
            'name' => 'Alat Buku Tulis',
            'icon' => 'icon-category/alat_buku_tulis.png'
        ]);
    }
}
