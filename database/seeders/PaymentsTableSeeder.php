<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('payments')->insert([
            [
                'booking_id' => 1,
                'status_id' => 4, // Ví dụ: 1 - Đã thanh toán
                'amount' => 1500000,
                'payment_date' => Carbon::now()->subDays(5),
                'payment_method' => 1, // Tiền mặt
                'code' => null,
                'payment_gateway_response' => null,
            ],
            [
                'booking_id' => 2,
                'status_id' => 2, // Ví dụ: 2 - Chờ thanh toán
                'amount' => 800000,
                'payment_date' => Carbon::now()->subDays(2),
                'payment_method' => 2, // Chuyển khoản
                'code' => 'GD00123',
                'payment_gateway_response' => json_encode(['transaction_id' => '123456789', 'status' => 'success']),
            ],
            [
                'booking_id' => 3,
                'status_id' => 4, // Ví dụ: 1 - Đã thanh toán
                'amount' => 2000000,
                'payment_date' => Carbon::now(), // Thanh toán hôm nay
                'payment_method' => 2, // Chuyển khoản
                'code' => 'GD00456',
                'payment_gateway_response' => json_encode(['transaction_id' => '987654321', 'status' => 'pending']),
            ],
        ]);
    }
}
