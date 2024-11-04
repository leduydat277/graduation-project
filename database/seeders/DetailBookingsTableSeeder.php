<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailBookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $bookingIds = range(1, 100);
        $roomIds = range(1, 300);
        $roomTypeIds = range(1, 100);  // Giả định có 100 loại phòng

        for ($i = 1; $i <= 300; $i++) {  // Tạo 1000 bản ghi chi tiết booking
            DB::table('detail_bookings')->insert([
                'booking_id' => $faker->randomElement($bookingIds),
                'room_id' => $faker->randomElement($roomIds),
                'room_type_id' => $faker->randomElement($roomTypeIds),
                'CCCD' => $faker->numerify('############'), // 12 chữ số ngẫu nhiên
                'actual_number_people' => rand(1, 6), // Số người từ 1 đến 6
                'create_at' => now(),
                'update_at' => now(),
            ]);
        }
    }
}
