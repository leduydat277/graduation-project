<?php

namespace Database\Seeders;

use App\Models\AssetsType;
use App\Models\Room;
use App\Models\RoomAsset;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomAssetsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('roomassets')->insert([
                'assets_type_id' => $faker->numberBetween(1, 10), // Giả lập ID loại tài sản từ 1 đến 10
                'room_id' => $faker->numberBetween(1, 50), // Giả lập ID phòng từ 1 đến 50
                'status' => $faker->randomElement([0, 1]), // Trạng thái: 0 - đang sử dụng, 1 - tạm dừng sử dụng
                'created_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
                'updated_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
            ]);
        }
    }
}
