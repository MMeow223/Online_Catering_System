<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'institution_name' => 'Swinburne University of Technology Sarawak Campus',
            'institution_address' => 'Q5B, 93350 Kuching, Sarawak',
            'email' => 'swinburne@swinburne.edu.my',
            'phone' => '+60 82 415 353',
            'is_member' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
