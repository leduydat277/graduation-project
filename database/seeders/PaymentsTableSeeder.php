<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Booking;
use App\Models\Payment;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi payment
        for ($i = 0; $i < 10; $i++) {
            // Lấy một booking_id ngẫu nhiên
            $booking_id = Booking::inRandomOrder()->first()->id;

            Payment::create([
                'booking_id' => $booking_id,
                'payment_date' => $faker->dateTimeThisYear()->format('U'), // Định dạng timestamp
                'total_price' => $faker->numberBetween(100000, 1000000),
                'payment_method' => $faker->randomElement([0, 1]), // 0: tiền mặt, 1: chuyển khoản
            ]);
        }
    }
}
