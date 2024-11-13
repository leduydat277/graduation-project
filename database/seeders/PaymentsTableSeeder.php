<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('payments')->insert([
                'booking_id' => $faker->numberBetween(1, 50), // Giả lập ID booking từ 1 đến 50
                'payment_date' => Carbon::now()->timestamp, // Thời gian thanh toán dưới dạng Unix timestamp
                'total_price' => $faker->optional()->numberBetween(100000, 10000000), // Tổng giá thanh toán ngẫu nhiên, có thể NULL
                'payment_method' => $faker->randomElement([0, 1]), // Phương thức thanh toán: 0: tiền mặt, 1: chuyển khoản
                'payment_status' => $faker->numberBetween(0, 3), // Trạng thái thanh toán: 0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn
                'vnp_BankCode' => $faker->optional()->word, // Mã ngân hàng, có thể NULL
                'vnp_TransactionNo' => $faker->optional()->uuid, // Mã giao dịch VNPay, có thể NULL
                'updated_at' => Carbon::now()->timestamp, // Thời gian cập nhật dưới dạng Unix timestamp
            ]);
        }
    }
}
