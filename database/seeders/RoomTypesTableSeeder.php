<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('room_types')->insert([
                'type' => $faker->words(2, true), // Tên loại phòng
                'defaul_people' => $faker->numberBetween(1, 4), // Số người mặc định
                'price_per_night' => $faker->numberBetween(500000, 3000000), // Giá 1 đêm (500k - 3M VND)
                'description' => $faker->sentence(), // Mô tả ngắn
                'description_details' => $faker->paragraph(), // Chi tiết mô tả
                'title' => $faker->words(3, true), // Tiêu đề loại phòng
                'create_at' => now(), // Thời gian tạo
                'update_at' => now(), // Thời gian cập nhật
            ]);
        }
    }
}
