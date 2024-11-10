<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TokensTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tokens')->insert([
            [
                'users_id' => 1,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 2,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 3,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 4,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 5,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 6,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 7,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 8,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 9,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 10,
                'value' => bin2hex(random_bytes(16)),
                'expiry_time' => Carbon::now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
