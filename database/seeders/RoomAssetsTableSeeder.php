<?php

namespace Database\Seeders;

use App\Models\AssetsType;
use App\Models\Room;
use App\Models\RoomAsset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomAssetsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi cho bảng roomassets
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên assets_type_id từ bảng assets_types
            $assets_type_id = AssetsType::inRandomOrder()->first()->id;

            // Lấy ngẫu nhiên room_id từ bảng rooms
            $room_id = Room::inRandomOrder()->first()->id;

            // Trạng thái ngẫu nhiên (0: đang sử dụng, 1: tạm dừng sử dụng)
            $status = $faker->randomElement([0, 1]);

            // Tạo bản ghi vào bảng roomassets
            RoomAsset::create([
                'assets_type_id' => $assets_type_id, // assets_type_id ngẫu nhiên
                'room_id' => $room_id, // room_id ngẫu nhiên
                'status' => $status, // Trạng thái ngẫu nhiên
                'created_at' => time(), // Thời gian tạo
                'updated_at' => time(), // Thời gian cập nhật
            ]);
        }
    }
}
