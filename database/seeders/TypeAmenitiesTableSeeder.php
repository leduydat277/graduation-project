<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TypeAmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Tạo 20 loại tiện nghi ngẫu nhiên
        for ($i = 1; $i <= 20; $i++) {
            DB::table('type_amenities')->insert([
                'name' => ucfirst($faker->words(2, true)), // Tên tiện nghi (2 từ ghép)
                'description' => $faker->sentence(10), // Mô tả ngắn
                'create_at' => now(), // Thời gian tạo
                'update_at' => now(), // Thời gian cập nhật
            ]);
        }
    }
}
