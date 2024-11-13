<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\ManageStatusRoom;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ManageStatusRoomsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('manage_status_rooms')->insert([
                'booking_id' => $faker->optional()->numberBetween(1, 50), // Booking ID ngẫu nhiên có thể NULL
                'room_id' => $faker->numberBetween(1, 50), // Room ID từ 1 đến 50
                'status' => $faker->randomElement([0, 1, 2]), // Trạng thái phòng: 0: đã cọc, 1: sẵn sàng, 2: đang sử dụng
                'from' => Carbon::now()->timestamp, // Thời gian bắt đầu dưới dạng Unix timestamp
                'to' => Carbon::now()->addDays($faker->numberBetween(1, 10))->timestamp, // Thời gian kết thúc ngẫu nhiên trong vòng 10 ngày
            ]);
        }
    }
}
