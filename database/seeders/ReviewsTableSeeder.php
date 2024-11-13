<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('reviews')->insert([
                'user_id' => $faker->numberBetween(1, 20), // Giả lập ID người dùng từ 1 đến 20
                'room_id' => $faker->numberBetween(1, 50), // Giả lập ID phòng từ 1 đến 50
                'rating' => $faker->numberBetween(1, 5), // Giả lập đánh giá từ 1 đến 5 sao
                'comment' => $faker->optional()->sentence(10), // Bình luận ngẫu nhiên, có thể NULL
                'created_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
            ]);
        }
    }
}
