<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('promotion_vouchers')->insert([
                'voucher_code' => 'VOUCHER' . $i,
                'voucher_name' => 'Voucher ' . $i,
                'voucher_description' => 'Voucher ' . $i,
                'discount' => rand(1, 100),
                'price_limit' => rand(1, 500),
                'discount_type' => 'simple discount',
                'expiry_date' => now()->addDays(14),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
