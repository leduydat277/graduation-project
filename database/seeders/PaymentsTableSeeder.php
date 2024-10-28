<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 

    {
        $faker = Faker::create();
        $bookingIds = range(1,100);
        for ($i = 0; $i < 50; $i++) { 
            DB::table('payments')->insert([
                'booking_id' => $faker->randomElement($bookingIds),
                'status_id' => $faker->numberBetween(1, 4),
                'amount' => $faker->numberBetween(10000, 1000000), // Số tiền thanh toán từ 100 đến 10000
                'payment_method' => $faker->randomElement([1, 2]), // 1 - Tiền mặt, 2 - Chuyển khoản
                'code' => $faker->optional()->regexify('[A-Z0-9]{10}'), // Mã giao dịch (có thể null)
                'payment_gateway_response' => $faker->optional()->json, // Dữ liệu JSON (có thể null)
            ]);
        }
    }
}