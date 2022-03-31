<?php

namespace Database\Seeders;

use App\Models\Pharmacies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'owner_id' => 1,
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
