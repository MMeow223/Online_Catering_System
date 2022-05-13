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
        // create an array with different good category
        $goodsCategories = ['Malaysian','English', 'American', 'Chinese', 'Japanese', 'Korean', 'Indian',  'Snack', 'Other'];
        for($i = 0; $i < count($goodsCategories); $i++) {
            DB::table('good_categories')->insert([
                'category_title' => $goodsCategories[$i],
                'category_description' => 'Category ' . $goodsCategories[$i] . ' description',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
