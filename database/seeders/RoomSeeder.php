<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Mảng chứa tên ảnh
        $images = [];
        for ($i = 1; $i <= 43; $i++) {
            $images[] = "img_$i.png"; // Tên ảnh
        }

        for ($i = 1; $i <= 100; $i++) { // Giả sử bạn muốn fake 100 phòng
            // Random số lượng ảnh từ 1 đến 5
            $randomImageCount = rand(1, 5);
            // Chọn ngẫu nhiên các chỉ số ảnh
            $selectedImages = array_rand($images, $randomImageCount);
            $imageRoomArray = [];

            // Kiểm tra xem selectedImages có phải là một mảng hay không
            if (!is_array($selectedImages)) {
                $selectedImages = [$selectedImages]; // Nếu không, chuyển đổi thành mảng
            }

            // Tạo mảng ảnh với đường dẫn đầy đủ
            foreach ($selectedImages as $index) {
                $imageRoomArray[] = "/storage/fakeimg/{$images[$index]}";
            }

            DB::table('rooms')->insert([
                'room_type_id' => rand(1, 9), // Random loại phòng từ 1 đến 9
                'image_room' => json_encode($imageRoomArray), // Random ảnh với đường dẫn đầy đủ
                'max_people' => rand(1, 4), // Random số người tối đa
                'title' => "Room Title $i",
                'price' => rand(500000, 2000000), // Random giá phòng
                'room_area' => rand(20, 100), // Random diện tích phòng
                'description' => "This is a detailed description for Room $i. It includes various amenities such as air conditioning, free Wi-Fi, a flat-screen TV, and a comfortable bed to ensure a pleasant stay for our guests. Perfect for both business travelers and vacationers, this room provides a cozy atmosphere and easy access to all major attractions in the area.", // Mô tả phòng dài hơn
                'status' => rand(0, 3), // Random trạng thái phòng
            ]);
        }
    }
}
