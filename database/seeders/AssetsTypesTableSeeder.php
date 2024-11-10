<?php

namespace Database\Seeders;

use App\Models\AssetsType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AssetsTypesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Danh sách các loại tiện nghi
        $assetTypes = [
            'Wi-Fi',
            'Máy lạnh',
            'Thang máy',
            'Bể bơi',
            'Phòng gym',
            'Bãi đậu xe',
            'Sân golf',
            'Khu vực BBQ',
            'Phòng xông hơi',
            'Tiện nghi cho người khuyết tật',
        ];

        // Giả lập 10 bản ghi cho bảng assets_types
        foreach ($assetTypes as $type) {
            AssetsType::create([
                'name' => $type, // Tên loại tiện nghi
                'description' => $faker->sentence(), // Mô tả tiện nghi
            ]);
        }
    }
}
