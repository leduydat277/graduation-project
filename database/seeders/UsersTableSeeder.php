<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Giả lập 10 bản ghi user
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name, // Tạo tên ngẫu nhiên
                'email' => $faker->unique()->safeEmail, // Tạo email duy nhất
                'cccd' => $faker->numerify('###########'), // Tạo số CCCD ngẫu nhiên
                'password' => bcrypt('password'), // Mã hóa mật khẩu
                'image' => $faker->imageUrl(200, 200, 'people'), // Tạo URL hình ảnh ngẫu nhiên
                'phone' => $faker->phoneNumber, // Tạo số điện thoại ngẫu nhiên
                'role' => $faker->randomElement([0, 1]), // Chọn ngẫu nhiên 0 hoặc 1 cho role (user hoặc admin)
            ]);
        }
    }
}
