<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi review
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên user_id và room_id từ bảng users và rooms
            $user_id = User::inRandomOrder()->first()->id;
            $room_id = Room::inRandomOrder()->first()->id;

            Review::create([
                'user_id' => $user_id, // Lấy user_id ngẫu nhiên
                'room_id' => $room_id, // Lấy room_id ngẫu nhiên
                'rating' => $faker->numberBetween(1, 5), // Đánh giá ngẫu nhiên từ 1 đến 5
                'comment' => $faker->optional()->sentence, // Nhận xét ngẫu nhiên, có thể để trống
                'created_at' => time(), // Sử dụng thời gian Unix timestamp
                'updated_at' => time(), // Sử dụng thời gian Unix timestamp
            ]);
        }
    }
}
