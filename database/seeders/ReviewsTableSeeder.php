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

        // Lấy tất cả ID của users và rooms đã fake trước đó
        $userIds = DB::table('users')->pluck('id')->toArray();
        $roomIds = DB::table('rooms')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('reviews')->insert([
                'user_id' => $faker->randomElement($userIds), // Chọn ID người dùng ngẫu nhiên từ bảng users
                'room_id' => $faker->randomElement($roomIds), // Chọn ID phòng ngẫu nhiên từ bảng rooms
                'rating' => $faker->numberBetween(1, 5), // Giả lập đánh giá từ 1 đến 5 sao
                'comment' => $faker->optional()->sentence(10), // Bình luận ngẫu nhiên, có thể NULL
                'created_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
            ]);
        }

    }
}
