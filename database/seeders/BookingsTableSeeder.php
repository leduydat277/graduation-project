<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Giả sử bạn có 50 người dùng
        $userIds = range(1, 50);

        for ($i = 1; $i <= 100; $i++) { // Tạo 500 lượt booking
            $checkInDate = $faker->dateTimeBetween('-30 days', '+30 days'); // Ngẫu nhiên trong 30 ngày qua và 30 ngày tới
            $checkOutDate = (clone $checkInDate)->modify('+'.rand(1, 7).' days'); // Check-out từ 1 đến 7 ngày sau

            DB::table('bookings')->insert([
                'user_id' => $faker->randomElement($userIds),
                'status_id' => '1',
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'VAT' => 10, // Giả định VAT là 10%
                'total_price' => $faker->randomFloat(2, 100, 5000), // Giá từ 100 đến 5000
                'note' => $faker->sentence(20), //ghi chú
                'surcharge' => rand(0, 1000), // Phụ phí từ 0 đến 1000 (ngẫu nhiên)
                'deposit_amount' => $faker->optional()->randomElement([500, 1000, 2000]), // Ngẫu nhiên tiền cọc
                'deposit_status' => $faker->randomElement(['pending', 'paid', 'refunded']),
                'deposit_date' => $faker->optional()->dateTimeBetween('-10 days', 'now'),
                'deposit_refund_date' => $faker->optional()->dateTimeBetween('-5 days', 'now'),
                'type' => rand(1, 2), // 1 - Online, 2 - Tại quầy
                'create_at' => now(),
                'update_at' => now(),
            ]);
        }
    }
}
