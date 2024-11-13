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
        DB::table('assets_types')->insert([
            [
                'name' => 'Máy lạnh',
                'description' => 'Tiện nghi giúp làm mát phòng',
            ],
            [
                'name' => 'Tivi',
                'description' => 'Tiện nghi giải trí trong phòng',
            ],
            [
                'name' => 'Tủ lạnh',
                'description' => 'Tiện nghi lưu trữ thực phẩm và đồ uống',
            ],
            [
                'name' => 'Wifi',
                'description' => 'Mạng internet không dây miễn phí trong phòng',
            ],
            [
                'name' => 'Giường',
                'description' => 'Giường ngủ cho khách',
            ],
            [
                'name' => 'Bàn làm việc',
                'description' => 'Tiện nghi phục vụ công việc hoặc học tập',
            ],
            [
                'name' => 'Bồn tắm',
                'description' => 'Tiện nghi phòng tắm cao cấp',
            ],
            [
                'name' => 'Máy sấy tóc',
                'description' => 'Tiện nghi sấy tóc sau khi tắm',
            ],
            [
                'name' => 'Điều hòa',
                'description' => 'Tiện nghi điều hòa nhiệt độ',
            ],
            [
                'name' => 'Máy giặt',
                'description' => 'Tiện nghi giặt đồ trong phòng',
            ],
        ]);
    }
}
