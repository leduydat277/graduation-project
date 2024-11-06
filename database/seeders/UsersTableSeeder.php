<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Tạo tài khoản Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'cccd' => '012345678901', // Thêm trường cccd (nếu có)
            'password' => Hash::make('admin123'), // Mật khẩu mã hóa
            'image' => null,
            'phone' => '0123456789',
            'role' => 1, // Admin
            'created_at' => now()->timestamp, // Lưu timestamp
            'updated_at' => now()->timestamp, // Lưu timestamp
        ]);

        // Tạo 50 tài khoản người dùng khác
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'cccd' => $faker->numerify('############'), // Số CCCD ngẫu nhiên
                'password' => Hash::make('password'), // Mật khẩu mã hóa
                'image' => $faker->imageUrl(200, 200, 'people'), // Ảnh người ngẫu nhiên
                'phone' => $faker->phoneNumber,
                'role' => rand(2, 4), // Lễ tân, Quản lý, Khách hàng
                'created_at' => now()->timestamp, // Lưu timestamp
                'updated_at' => now()->timestamp, // Lưu timestamp
            ]);
        }
    }
}
