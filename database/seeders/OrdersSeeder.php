<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $users_id= DB::table('users')->pluck('id');
        for ($i = 1; $i <= 50; $i++) {

            DB::table('orders')->insert([
                'user_id' =>  $users_id[0],
                'delivery_time' => now(),
                'total_price' => random_int(1,999),
                'payment_id' => $i,
                'is_prepared' => true,
                'is_delivered' => (bool)random_int(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
