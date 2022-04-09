<?php

namespace Database\Seeders;

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
        ]);
    }
}
