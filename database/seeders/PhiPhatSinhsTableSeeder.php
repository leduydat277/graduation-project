<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\PhiPhatSinh;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PhiPhatSinhsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi cho bảng phiphatsinhs
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên booking_id từ bảng bookings
            $booking_id = Booking::inRandomOrder()->first()->id;

            // Tạo các tên phí phát sinh
            $names = ['Phí vệ sinh', 'Phí dịch vụ phòng', 'Phí điện nước', 'Phí đỗ xe', 'Phí bảo hiểm phòng'];

            // Chọn ngẫu nhiên tên phí phát sinh
            $name = $faker->randomElement($names);

            // Giá phí phát sinh ngẫu nhiên
            $price = $faker->numberBetween(100000, 500000); // Giá từ 100k đến 500k

            // Mô tả phí phát sinh ngẫu nhiên
            $description = $faker->optional()->sentence(); // Có thể có hoặc không có mô tả

            // Tạo bản ghi vào bảng phiphatsinhs
            PhiPhatSinh::create([
                'booking_id' => $booking_id,
                'name' => $name,
                'description' => $description,
                'image' => $faker->imageUrl(), // Tạo URL hình ảnh giả
                'price' => $price, // Giá phí phát sinh
                'created_at' => time(),
                'updated_at' => time(),
            ]);
        }
    }
}
