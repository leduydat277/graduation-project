<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('bookings')->insert([
                'room_id' => $faker->numberBetween(1, 50), // Room ID ngẫu nhiên từ 1 đến 50
                'user_id' => $faker->optional()->numberBetween(1, 50), // User ID ngẫu nhiên có thể NULL
                'code_check_in' => $faker->unique()->word, // Mã check-in ngẫu nhiên
                'check_in_date' => Carbon::now()->addDays($faker->numberBetween(1, 10))->timestamp, // Thời gian check-in ngẫu nhiên trong 10 ngày tới
                'check_out_date' => Carbon::now()->addDays($faker->numberBetween(11, 20))->timestamp, // Thời gian check-out sau thời gian check-in
                'total_price' => $faker->numberBetween(500000, 2000000), // Tổng giá phòng ngẫu nhiên trong khoảng 500k đến 2 triệu
                'tien_coc' => $faker->numberBetween(100000, 500000), // Tiền cọc ngẫu nhiên
                'status' => $faker->randomElement([0, 1, 2, 3, 4, 5]), // Trạng thái: từ 0 đến 5
                'created_at' => Carbon::now()->timestamp, // Thời gian tạo bản ghi
                'updated_at' => Carbon::now()->timestamp, // Thời gian cập nhật bản ghi
                'first_name' => $faker->firstName, // Tên người dùng
                'last_name' => $faker->lastName, // Họ người dùng
                'email' => $faker->safeEmail, // Email người dùng
                'phone' => $faker->phoneNumber, // Số điện thoại người dùng
                'address' => $faker->address, // Địa chỉ người dùng
                'CCCD_booking' => $faker->numerify('###########'), // Số CCCD ngẫu nhiên
            ]);
        }
    }
}
