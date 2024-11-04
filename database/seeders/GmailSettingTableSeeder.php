<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GmailSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $settings = [];
        for ($i = 0; $i < 10; $i++) { // Thay đổi số lượng nếu cần
            $settings[] = [
                'status_id' => $faker->numberBetween(1, 4), // Giả sử có 4 trạng thái
                'content' => $faker->sentence(), // Nội dung ngẫu nhiên
                'type' => $faker->numberBetween(1, 5), // Phân biệt từng nội dung (có thể thay đổi theo yêu cầu)
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('gmail_setting')->insert($settings);
    }
}
