<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\ManageStatusRoom;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ManageStatusRoomsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi cho bảng manage_status_rooms
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên booking_id và room_id từ bảng bookings và rooms
            $booking_id = Booking::inRandomOrder()->first()->id;
            $room_id = Room::inRandomOrder()->first()->id;

            // Lấy ngày vào (date_in) và ngày ra (date_out) ngẫu nhiên
            $date_in = $faker->dateTimeThisYear()->getTimestamp();
            $date_out = $faker->dateTimeThisYear()->getTimestamp();

            // Đảm bảo ngày ra phải sau ngày vào
            if ($date_in > $date_out) {
                $date_out = $date_in + 86400; // Thêm 1 ngày (86400 giây) nếu date_out < date_in
            }

            // Lấy trạng thái ngẫu nhiên
            $status = $faker->numberBetween(0, 3); // Trạng thái từ 0 đến 3

            // Tạo bản ghi vào bảng manage_status_rooms
            ManageStatusRoom::create([
                'booking_id' => $booking_id, // Lấy booking_id ngẫu nhiên
                'room_id' => $room_id, // Lấy room_id ngẫu nhiên
                'status' => $status, // Trạng thái phòng ngẫu nhiên
                'date_in' => $date_in, // Ngày vào
                'date_out' => $date_out, // Ngày ra
            ]);
        }
    }
}
