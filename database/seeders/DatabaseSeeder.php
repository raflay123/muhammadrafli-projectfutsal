<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Admin Futsal',
            'email' => 'admin@futsal.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create owner user
        DB::table('users')->insert([
            'name' => 'Owner Venue',
            'email' => 'owner@futsal.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'phone' => '081234567891',
            'address' => 'Jl. Owner No. 1',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create regular user
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@futsal.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '081234567892',
            'address' => 'Jl. User No. 1',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample venues
        DB::table('venues')->insert([
            'name' => 'Lapangan Futsal Merdeka',
            'description' => 'Lapangan futsal dengan rumput sintetis berkualitas tinggi',
            'location' => 'Jl. Merdeka No. 123',
            'price_per_hour' => 150000,
            'open_time' => '08:00',
            'close_time' => '22:00',
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('venues')->insert([
            'name' => 'Futsal Center Sportama',
            'description' => 'Lapangan standar nasional dengan lighting profesional',
            'location' => 'Jl. Sportama No. 45',
            'price_per_hour' => 200000,
            'open_time' => '07:00',
            'close_time' => '23:00',
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample booking
        DB::table('bookings')->insert([
            'user_id' => 3, // user regular
            'venue_id' => 1,
            'booking_date' => now()->addDays(1)->format('Y-m-d'),
            'start_time' => '14:00',
            'end_time' => '16:00',
            'duration' => 2,
            'total_price' => 300000,
            'status' => 'pending',
            'notes' => 'Booking untuk latihan tim',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}