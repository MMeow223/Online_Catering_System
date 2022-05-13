<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckoutGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $order_id = DB::table('orders')->get()->random()->id;
            $good_id = DB::table('goods')->get()->random()->id;
            $variety_id = DB::table('good_varieties')->get()->random()->id;


            DB::table('checkout_goods')->insert([
                'order_id' => $order_id,
                'good_id' => $good_id,
                'variety_id' => $variety_id,
                'quantity' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
