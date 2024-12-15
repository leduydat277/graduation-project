<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\PhiPhatSinh;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PhiPhatSinhsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('phiphatsinhs')->insert([
                'booking_id' => $faker->numberBetween(1, 50), // Giả lập ID booking từ 1 đến 50
                'name' => $faker->word, // Tên phí phát sinh ngẫu nhiên
                'description' => $faker->optional()->text, // Mô tả phí phát sinh có thể NULL
                'image' => $faker->optional()->imageUrl(200, 200), // URL hình ảnh ngẫu nhiên, có thể NULL
                'price' => $faker->numberBetween(100000, 1000000), // Giả lập giá từ 100,000 đến 1,000,000
                'created_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
                'updated_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
            ]);
        }
    }
}
