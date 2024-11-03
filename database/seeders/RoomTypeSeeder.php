<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roomTypes = [
            ['type' => 'Deluxe Room'],
            ['type' => 'Executive Room'],
            ['type' => 'Family Room'],
            ['type' => 'Presidential Suite'],
            ['type' => 'Standard Room'],
            ['type' => 'Luxury Room'],
            ['type' => 'Economy Room'],
            ['type' => 'King Room'],
            ['type' => 'Queen Room'],
            ['type' => 'Studio Room'],
        ];

        DB::table('room_types')->insert($roomTypes);
    }
}
