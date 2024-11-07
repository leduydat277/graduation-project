<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi room
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên room_type_id từ bảng room_types
            $room_type_id = RoomType::inRandomOrder()->first()->id;

            // Tạo ảnh phòng giả dưới dạng JSON
            $image_room = json_encode([
                $faker->imageUrl(640, 480, 'room', true), // URL ảnh ngẫu nhiên
                $faker->imageUrl(640, 480, 'room', true), // URL ảnh ngẫu nhiên
                $faker->imageUrl(640, 480, 'room', true), // URL ảnh ngẫu nhiên
            ]);

            // Tạo giá phòng ngẫu nhiên
            $price = $faker->numberBetween(500000, 2000000); // Giá phòng từ 500k đến 2 triệu

            // Tạo diện tích phòng ngẫu nhiên
            $room_area = $faker->numberBetween(20, 100); // Diện tích phòng từ 20 đến 100 m²

            Room::create([
                'room_type_id' => $room_type_id, // Lấy room_type_id ngẫu nhiên
                'image_room' => $image_room, // Danh sách ảnh phòng dạng JSON
                'max_people' => $faker->numberBetween(1, 5), // Số người tối đa ngẫu nhiên từ 1 đến 5
                'title' => $faker->word, // Tiêu đề phòng ngẫu nhiên
                'price' => $price, // Giá phòng ngẫu nhiên
                'room_area' => $room_area, // Diện tích phòng ngẫu nhiên
                'description' => $faker->optional()->sentence, // Mô tả phòng ngẫu nhiên (có thể để trống)
                'status' => $faker->numberBetween(0, 3), // Trạng thái phòng ngẫu nhiên từ 0 đến 3 (sẵn sàng, đã cọc, đang sử dụng, hỏng)
            ]);
        }
    }
}
