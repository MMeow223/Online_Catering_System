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
//            create an array and generate a random number between 0 and 1, then put it in the array
//            if the first number is 1, then generate another random number between 0 and 1, and put it in the array
//            otherwise, put 0 in the array
            $array = [];
            $array[] = rand(0, 1);
            if ($array[0] == 1) {
                $array[] = rand(0, 1);
            } else {
                $array[] = 0;
            }

            // import faker
            $faker = Factory::create();

            DB::table('orders')->insert([
                'user_id' =>  $users_id[1],
                'delivery_time' => $faker->dateTimeBetween('-3 days', '+3 days'),
                'total_price' => $faker->randomFloat(2, 0, 100),
                // randomly assign the payment_id from the payment table
                'payment_id' => $i,
                'is_prepared' => $array[0],
                'is_delivered' => $array[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


        }

    }
}
