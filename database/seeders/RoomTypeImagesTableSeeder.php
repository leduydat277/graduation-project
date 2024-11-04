<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomTypeImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Giả sử bảng room_types đã có sẵn 1000 bản ghi
        $roomTypeIds = range(1, 1000); // ID loại phòng từ 1 đến 1000

        foreach ($roomTypeIds as $roomTypeId) {
            // Tạo 3-5 ảnh cho mỗi loại phòng
            for ($i = 0; $i < rand(3, 5); $i++) {
                DB::table('room_type_images')->insert([
                    'room_type_id' => $roomTypeId,
                    'image_url' => $faker->imageUrl(640, 480, 'room'), // Ảnh phòng ngẫu nhiên
                    'description' => $faker->sentence(), // Mô tả dịch vụ ngắn
                    'create_at' => now(), // Thời gian tạo
                    'update_at' => now(), // Thời gian cập nhật
                ]);
            }
        }
    }
}
