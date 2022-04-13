<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $good_category_id = DB::table('good_categories')->get()->random()->id;

            DB::table('goods')->insert([
                'good_name' => 'Noodle'.$i,
                'good_description' => 'This is a bowl of noodle'.$i,
                'good_image' => 'noodle.jpg',
                'good_price' => '10',
                'good_category_id' => $good_category_id,
                'is_warm' => true,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
