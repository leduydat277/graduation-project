<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $reviews = [];
        for ($i = 0; $i < 100; $i++) {
            $reviews[] = [
                'user_id' => $faker->numberBetween(1, 100), // Giả sử có 100 người dùng
                'room_type_id' => $faker->numberBetween(1, 100), // Giả sử có 100 loại phòng
                'status_id' => $faker->numberBetween(1, 4), // Giả sử có 4 trạng thái
                'content' => $faker->sentence(10), // Nội dung bình luận
                'rating' => $faker->numberBetween(1, 5), // Đánh giá từ 1 đến 5
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('reviews')->insert($reviews);
    }
}
