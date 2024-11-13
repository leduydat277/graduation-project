<?php

namespace Database\Seeders;

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

        for ($i = 0; $i < 50; $i++) {
            DB::table('rooms')->insert([
                'room_type_id' => $faker->numberBetween(1, 5), // Giả lập ID loại phòng từ 1 đến 5
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
                'status' => $faker->numberBetween(0,3), // Trạng thái phòng
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
