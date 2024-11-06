<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Giả sử bạn có 10 loại phòng và 3 trạng thái phòng
        $roomTypeIds = range(1, 100);
        $roomStatusIds = range(1, 4);

        for ($i = 1; $i <= 300; $i++) {  // Tạo 300 phòng
            DB::table('rooms')->insert([
                'room_type_id' => $faker->randomElement($roomTypeIds),
                'image_room' => $faker->imageUrl(200, 200, 'people'), 
                'max_people' => $i, // Số phòng từ 1 đến 200
                'price' => $i, // Số phòng từ 1 đến 200
                "room_area" => $i,
                'description' => $faker->sentence(10), // Số phòng từ 1 đến 200
                'title' => $faker->sentence(10), // Mô tả ngẫu nhiên
                "status" => rand(0, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
