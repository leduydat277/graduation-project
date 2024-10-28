<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Hoạt động', 'type' => 0, 'color' => 'green', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Bị khóa', 'type' => 0, 'color' => 'red', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Phòng trống', 'type' => 1, 'color' => 'blue', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Đã thanh toán', 'type' => 3, 'color' => 'green', 'create_at' => now(), 'update_at' => now()],
        ];

        DB::table('statuses')->insert($statuses);
    }
}
