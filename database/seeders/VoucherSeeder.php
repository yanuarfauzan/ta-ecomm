<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voucher::create([
            'name' => 'Gratis Ongkir',
            'type' => 'free ongkir',
            'voucher_icon' => 'gratis_ongkir.png',
            'voucher_code' => 'GRATISONGKIR',
            'requirement' => '100000',
            'discount_value' => '20000',
            'expired_at' => '2024-05-18',
            'is_active' => true
        ]);
        Voucher::create([
            'name' => 'Promo',
            'type' => 'discount',
            'voucher_icon' => 'discount.svg',
            'voucher_code' => 'PROMOECM',
            'requirement' => '70000',
            'discount_value' => '15000',
            'expired_at' => '2024-05-18',
            'is_active' => true
        ]);
    }
}
