<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $statuses = [
            [
                'room_id' => 1, // ID phòng, có thể thay đổi theo cơ sở dữ liệu hiện tại
                'status_id' => 1, // 1 - Trạng thái tốt
                'description' => 'Phòng trong tình trạng tốt.',
                'user_id' => 1, // ID người báo cáo, có thể thay đổi
                'create_at' => now(),
                'update_at' => now(),
            ],
            [
                'room_id' => 2,
                'status_id' => 1, // 2 - Trạng thái cần sửa chữa
                'description' => 'Phòng cần sửa chữa một số thiết bị.',
                'user_id' => 2,
                'create_at' => now(),
                'update_at' => now(),
            ],
            [
                'room_id' => 3,
                'status_id' => 1, // 3 - Trạng thái không sử dụng
                'description' => 'Phòng hiện tại không thể sử dụng.',
                'user_id' => 3,
                'create_at' => now(),
                'update_at' => now(),
            ],
            [
                'room_id' => 4,
                'status_id' => 1,
                'description' => 'Phòng đã được kiểm tra và trong tình trạng tốt.',
                'user_id' => 1,
                'create_at' => now(),
                'update_at' => now(),
            ],
            [
                'room_id' => 5,
                'status_id' => 1,
                'description' => 'Phòng bị ẩn.',
                'user_id' => 1,
                'create_at' => now(),
                'update_at' => now(),
            ],
        ];

        DB::table('room_statuses')->insert($statuses);
    }
}
