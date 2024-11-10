<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomTypesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Danh sách các loại phòng để fake
        $roomTypes = [
            'Single Room',
            'Double Room',
            'Suite Room',
            'Family Room',
            'Penthouse',
            'Deluxe Room',
            'Standard Room',
            'Executive Room',
            'Junior Suite',
            'Presidential Suite',
        ];

        foreach ($roomTypes as $type) {
            RoomType::create([
                'type' => $type,
                'created_at' => 1730964385,
                'updated_at' => 1730964385,
            ]);
        }
    }
}
