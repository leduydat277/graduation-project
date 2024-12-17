<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\BookingsTableSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\ManageStatusRoomsTableSeeder;
use Database\Seeders\PaymentsTableSeeder;
use Database\Seeders\PhiPhatSinhsTableSeeder;
use Database\Seeders\RoomsTableSeeder;
use Database\Seeders\RoomTypesTableSeeder;
use Database\Seeders\TokensTableSeeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoomTypesTableSeeder::class,
            RoomsTableSeeder::class,
            UsersTableSeeder::class,
            BookingsTableSeeder::class,
            AssetsTypesTableSeeder::class,
            RoomAssetsTableSeeder::class,
            ReviewsTableSeeder::class,
        ]);
    }
}
