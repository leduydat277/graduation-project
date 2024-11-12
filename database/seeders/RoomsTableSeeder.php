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
    
        // Kiểm tra và in ra đường dẫn đầy đủ của thư mục assets/img
        $img_path = public_path('assets/img');
        echo $img_path; // In đường dẫn thư mục để kiểm tra
        
        if (!is_dir($img_path)) {
            throw new \Exception("Thư mục '$img_path' không tồn tại.");
        }
    
        // Lấy tất cả các ảnh trong thư mục public/assets/img
        $image_files = glob(public_path('assets/img/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE));
    
        // In ra số lượng ảnh tìm thấy
        echo "Số lượng ảnh tìm thấy: " . count($image_files) . PHP_EOL;
    
        // Kiểm tra nếu mảng ảnh không rỗng
        if (empty($image_files)) {
            // Nếu không có ảnh, trả về một thông báo lỗi hoặc xử lý phù hợp
            throw new \Exception('Không tìm thấy ảnh nào trong thư mục public/assets/img');
        }
    
        // Giả lập 10 bản ghi room
        for ($i = 0; $i < 10; $i++) {
            // Lấy ngẫu nhiên room_type_id từ bảng room_types
            $room_type_id = RoomType::inRandomOrder()->first()->id;
    
            // Chọn ngẫu nhiên 3 ảnh từ thư mục
            $image_room = json_encode([
                $this->getRandomImage($image_files), // Ảnh ngẫu nhiên 1
                $this->getRandomImage($image_files), // Ảnh ngẫu nhiên 2
                $this->getRandomImage($image_files), // Ảnh ngẫu nhiên 3
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
    
    /**
     * Hàm trả về một ảnh ngẫu nhiên từ danh sách các ảnh
     */
    private function getRandomImage($image_files)
    {
        return basename($image_files[array_rand($image_files)]); // Trả về tên tệp ảnh ngẫu nhiên
    }
    
}
