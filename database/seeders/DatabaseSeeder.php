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
            RoomTypeImagesTableSeeder::class,       // Seeder cho bảng room_type_images
            RoomAmenitiesTableSeeder::class,         // Seeder cho bảng room_amenities
            TypeAmenitiesTableSeeder::class,         // Seeder cho bảng type_amenities
            BookingsTableSeeder::class,              // Seeder cho bảng bookings
            DetailBookingsTableSeeder::class,        // Seeder cho bảng detail_bookings
            RoomsTableSeeder::class,                 // Seeder cho bảng rooms
            StatusTableSeeder::class,                // Seeder cho bảng status
            DamageReportsTableSeeder::class,         // Seeder cho bảng damage_reports
            ReviewsTableSeeder::class,               // Seeder cho bảng reviews
            DamageReportsImageTableSeeder::class,    // Seeder cho bảng damage_reports_image
            GmailSettingTableSeeder::class,          // Seeder cho bảng gmail_setting
            RoomStatusesTableSeeder::class,          // Seeder cho bảng room_statuses
        ]);
    }
}
