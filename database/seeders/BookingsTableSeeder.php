<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi booking
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên user_id và room_id từ bảng users và rooms
            $user_id = User::inRandomOrder()->first()->id;
            $room_id = Room::inRandomOrder()->first()->id;

            // Lấy thời gian ngẫu nhiên cho check_in_date và check_out_date
            $check_in_date = $faker->dateTimeThisYear()->getTimestamp();
            $check_out_date = $faker->dateTimeThisYear()->getTimestamp();

            // Đảm bảo check_out_date luôn lớn hơn check_in_date
            if ($check_in_date > $check_out_date) {
                $check_out_date = $check_in_date + 86400; // Thêm 1 ngày (86400 giây)
            }

            // Tính tổng giá (giả sử mỗi đêm phòng có giá ngẫu nhiên)
            $total_price = ($check_out_date - $check_in_date) / 86400 * $faker->numberBetween(1000, 3000);
            $tien_coc = $total_price * 0.3; // Tiền cọc là 30% của tổng giá

            Booking::create([
                'user_id' => $user_id, // Lấy user_id ngẫu nhiên
                'room_id' => $room_id, // Lấy room_id ngẫu nhiên
                'code_check_in' => strtoupper($faker->unique()->bothify('???-####')), // Mã check-in ngẫu nhiên
                'check_in_date' => $check_in_date, // Ngày check-in (Unix timestamp)
                'check_out_date' => $check_out_date, // Ngày check-out (Unix timestamp)
                'total_price' => $total_price, // Tổng giá tính từ thời gian thuê
                'tien_coc' => $tien_coc, // Tiền cọc
                'status' => $faker->numberBetween(0, 4), // Trạng thái ngẫu nhiên từ 0 đến 4
                'created_at' => time(), // Sử dụng thời gian Unix timestamp
                'updated_at' => time(), // Sử dụng thời gian Unix timestamp
            ]);
        }
    }
}
