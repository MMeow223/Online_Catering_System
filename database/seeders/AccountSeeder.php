<?php

namespace Database\Seeders;

use App\Models\Pharmacies;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        $user = User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'is_admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user -> customer()->create(['user_id'=>$user->user_id]);

    }
}
