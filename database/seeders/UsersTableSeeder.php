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

        // Tạo 1 tài khoản Admin
        DB::table('users')->insert([
            'status_id' => 1, // Trạng thái: Hoạt động
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'code' => null,
            'password' => Hash::make('admin123'), // Mật khẩu mã hóa
            'image' => null,
            'role' => 1, // Admin
            'phone' => '0123456789',
            'address' => '123 Admin Street',
            'create_at' => now(),
            'update_at' => now(),
        ]);

        // Tạo 50 tài khoản người dùng khác
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'status_id' => 1, // Trạng thái: Hoạt động
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'code' => null,
                'password' => Hash::make('password'), // Mật khẩu mã hóa
                'image' => $faker->imageUrl(200, 200, 'people'), // Ảnh người ngẫu nhiên
                'role' => rand(2, 4), // Lễ tân, Quản lý, Khách hàng
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'create_at' => now(),
                'update_at' => now(),
            ]);
        }
    }
}
