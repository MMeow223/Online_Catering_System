<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('good_categories')->insert([
                'category_title' => 'Category ' . $i,
                'category_description' => 'Category ' . $i . ' description',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
