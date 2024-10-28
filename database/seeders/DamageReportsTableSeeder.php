<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DamageReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $damageReports = [];
        for ($i = 0; $i < 100; $i++) {
            $damageReports[] = [
                'room_id' => $faker->numberBetween(1, 50), // Giả sử có 50 phòng
                'status_id' => $faker->numberBetween(1, 4), // Giả sử có 4 trạng thái
                'user_id' => $faker->numberBetween(1, 100), // Giả sử có 100 người dùng
                'booking_id' => $faker->numberBetween(1, 500), // Giả sử có 500 booking
                'damage_type' => $faker->sentence(3), // Ví dụ: "Cửa sổ bị vỡ"
                'compensation_amount' => $faker->optional()->numberBetween(100000, 500000), // Phụ phí
                'description' => $faker->optional()->text(200), // Mô tả chi tiết
                'reported_at' => $faker->dateTimeBetween('-1 year', 'now'), // Thời gian báo cáo ngẫu nhiên
                'resolved_at' => $faker->boolean, // 0-Chưa giải quyết, 1-Đã giải quyết
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('damage_reports')->insert($damageReports);
    }
}
