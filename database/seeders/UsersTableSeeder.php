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

        // Giả lập 50 bản ghi user
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'cccd' => $faker->numerify('###########'),
                'password' => bcrypt('password'),
                'image' => $faker->optional()->imageUrl(200, 200, 'people'),
                'phone' => $faker->optional()->phoneNumber,
                'address' => $faker->optional()->address,
                'role' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeThisYear()->getTimestamp(),
                'updated_at' => $faker->dateTimeThisYear()->getTimestamp(),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'deleted_at' => $faker->optional(0.2)->dateTime(), // 20% khả năng bị xóa
            ]);
        }
    }
}
