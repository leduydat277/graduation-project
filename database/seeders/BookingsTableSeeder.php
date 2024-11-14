<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\ManageStatusRoomController;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách ID của rooms và users
        $roomIds = Room::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $bookingId = DB::table('bookings')->insertGetId([
                'room_id' => $roomId = $faker->randomElement($roomIds),
                'user_id' => $faker->optional()->randomElement($userIds), // ID user ngẫu nhiên từ danh sách users, có thể là NULL
                'code_check_in' => $faker->unique()->word, // Mã check-in ngẫu nhiên
                'check_in_date' => $checkIn = Carbon::now()->addDays($faker->numberBetween(1, 10))->timestamp, // Thời gian check-in ngẫu nhiên trong 10 ngày tới
                'check_out_date' => $checkOut = Carbon::now()->addDays($faker->numberBetween(11, 20))->timestamp, // Thời gian check-out sau check-in
                'total_price' => $faker->numberBetween(500000, 2000000), // Tổng giá phòng ngẫu nhiên
                'tien_coc' => $faker->numberBetween(100000, 500000), // Tiền cọc ngẫu nhiên
                'status' => $faker->randomElement([0, 1, 2, 3, 4, 5]), // Trạng thái phòng
                'created_at' => Carbon::now()->timestamp, // Thời gian tạo
                'updated_at' => Carbon::now()->timestamp, // Thời gian cập nhật
                'first_name' => $faker->firstName, // Tên người dùng
                'last_name' => $faker->lastName, // Họ người dùng
                'email' => $faker->safeEmail, // Email người dùng
                'phone' => $faker->phoneNumber, // Số điện thoại
                'address' => $faker->address, // Địa chỉ
                'CCCD_booking' => $faker->numerify('###########'), // Số CCCD ngẫu nhiên
            ]);

            DB::table('payments')->insert([
                'booking_id' => $bookingId,
                'payment_date' => Carbon::now()->timestamp,
                'total_price' => $faker->optional()->numberBetween(100000, 10000000),
                'payment_method' => $faker->randomElement([0, 1]),
                'payment_status' => $faker->numberBetween(0, 3),
                'vnp_BankCode' => $faker->optional()->word,
                'vnp_TransactionNo' => $faker->optional()->uuid,
                'updated_at' => Carbon::now()->timestamp,
            ]);

            $from_new =  (new DateTime())->setTimestamp($checkIn)->format('Y-m-d');
            $to_new = (new DateTime())->setTimestamp($checkOut)->format('Y-m-d');
            $status = new ManageStatusRoomController;
            $status->create($bookingId, $roomId, $from_new, $to_new);
        }
    }
}
