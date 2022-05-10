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
            'user_id' => 1,
            'is_member' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('customers')->insert([
            'institution_name' => 'University of Malaya',
            'institution_address' => 'Kuala Lumpur, Malaysia',
            'email' => 'universitymalaysa@um.edu.my',
            'phone' => '+60 29 932 2002',
            'user_id' => 2,
            'is_member' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
