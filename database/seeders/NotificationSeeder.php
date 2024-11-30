<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 50; $i++) {
            Notification::create([
                'user_id' => 1,
                'title' => 'Đơn đặt phòng mới',
                'message' => '{"date":"09:46 20-11-2024","message":"Khách hàng Lê Linh đã đặt phòng Studio Room 1001.","booking_id":54}',
            ]);
        }
    }
}
