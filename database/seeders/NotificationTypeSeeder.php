<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notificationType = ['Orders', 'Promotions', 'Vouchers', 'Activities'];
        for($i = 0; $i < count($notificationType); $i++) {
            DB::table('notification_type')->insert([
                'notification_type' => $notificationType[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
