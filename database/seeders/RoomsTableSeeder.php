<?php

namespace Database\Seeders;

use App\Models\ManageStatusRoom;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy tất cả ID của room_types để chắc chắn ID hợp lệ
        $roomTypeIds = RoomType::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            // Chèn phòng mới và lấy ID của phòng vừa tạo
            $roomId = DB::table('rooms')->insertGetId([
                'room_type_id' => $faker->randomElement($roomTypeIds), // Chọn ID loại phòng ngẫu nhiên từ room_types
                'image_room' => json_encode([
                    $faker->imageUrl(640, 480, 'room'),
                    $faker->imageUrl(640, 480, 'room'),
                    $faker->imageUrl(640, 480, 'room'),
                ]), // Giả lập 3 ảnh dưới dạng JSON
                'max_people' => $faker->numberBetween(1, 4), // Số người tối đa từ 1 đến 4
                'title' => $faker->words(3, true), // Tên phòng
                'price' => $faker->numberBetween(500000, 5000000), // Giá ngẫu nhiên
                'room_area' => $faker->numberBetween(20, 100), // Diện tích phòng ngẫu nhiên
                'description' => $faker->optional()->paragraph, // Mô tả ngẫu nhiên, có thể NULL
                'status' => $faker->numberBetween(0, 3), // Trạng thái phòng
            ]);

            // Sau khi chèn phòng mới, sử dụng ID vừa lấy để chèn vào bảng manage_status_rooms
            // ManageStatusRoom::insert([
            //     'room_id' => $roomId,
            //     'status' => 1,
            //     'from' => Carbon::tomorrow()->setHour(14)->timestamp,
            //     'to' => 0,
            // ]);
        }
    }
}
