<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $goods_id = DB::table('goods')->get()->random()->id;

            DB::table('good_varieties')->insert([
                'good_id' => $i,
                'variety_name' => 'Variety ' . $goods_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            $goods_id = DB::table('goods')->get()->random()->id;

            DB::table('good_varieties')->insert([
                'good_id' => $i,
                'variety_name' => 'Variety ' . $goods_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
