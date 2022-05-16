<?php

namespace Database\Seeders;

use App\Models\PromotionVoucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
            AccountSeeder::class,
            GoodsCategoriesSeeder::class,
            GoodsSeeder::class,
            GoodsVarietySeeder::class,
            PaymentSeeder::class,

            OrdersSeeder::class,
            CheckoutGoodSeeder::class,
            PromotionVoucherSeeder::class,

            NotificationTypeSeeder::class,

        ]);
    }
}
