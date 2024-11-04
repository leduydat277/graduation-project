<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DamageReportsImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $images = [];
        for ($i = 0; $i < 100; $i++) {
            $images[] = [
                'damage_reports_id' => $faker->numberBetween(1, 100), // Giả sử có 100 báo cáo hỏng hóc
                'image_url' => $faker->imageUrl(), // Link ảnh ngẫu nhiên
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('damage_reports_image')->insert($images);
    }
}
