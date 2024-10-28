<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomAmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Giả sử bảng rooms có 500 phòng và bảng amenities có 20 loại tiện nghi
        $roomIds = range(1, 300); // ID phòng từ 1 đến 500
        $amenityIds = range(1, 20); // ID tiện nghi từ 1 đến 20
        $statusIds = range(1, 4); // ID trạng thái từ 1 đến 5

        foreach ($roomIds as $roomId) {
            // Gán 3-6 tiện nghi ngẫu nhiên cho mỗi phòng
            $randomAmenities = $faker->randomElements($amenityIds, rand(3, 6));

            foreach ($randomAmenities as $amenityId) {
                DB::table('room_amenities')->insert([
                    'amenities_id' => $amenityId,
                    'room_id' => $roomId,
                    'status_id' => $faker->randomElement($statusIds), // Chọn trạng thái ngẫu nhiên
                    'create_at' => now(), // Thời gian tạo
                    'update_at' => now(), // Thời gian cập nhật
                ]);
            }
        }
    }
}
