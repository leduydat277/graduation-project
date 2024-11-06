<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,                // Seeder cho bảng users
            RoomTypesTableSeeder::class,            // Seeder cho bảng room_types
            RoomsTableSeeder::class,                 // Seeder cho bảng rooms
        ]);
    }
}
