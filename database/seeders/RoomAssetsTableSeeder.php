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

        // Lấy tất cả ID của rooms và asset_types đã fake trước đó
        $roomIds = DB::table('rooms')->pluck('id')->toArray();
        $assetTypeIds = DB::table('assets_types')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('roomassets')->insert([
                'assets_type_id' => $faker->randomElement($assetTypeIds), // Chọn ID loại tài sản ngẫu nhiên từ bảng assets_types
                'room_id' => $faker->randomElement($roomIds), // Chọn ID phòng ngẫu nhiên từ bảng rooms
                'status' => $faker->randomElement([0, 1]), // Trạng thái: 0 - đang sử dụng, 1 - tạm dừng sử dụng
                'created_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
                'updated_at' => Carbon::now()->timestamp, // Thời gian hiện tại dưới dạng Unix timestamp
            ]);
        }
    }
}
