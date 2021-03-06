<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('payments')->insert([
                'payment_method' => 'Bank'.$i,
                'account_number' => random_int(1000000000,9999999999),
                'transaction_id' => 'Transaction'.$i,
                'total_amount' => random_int(100,200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
