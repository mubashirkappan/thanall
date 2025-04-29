<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Assuming you're using a User model

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin user already exists
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            // Create the admin user
            User::create([
                'f_name' => 'Admin',
                'l_name' => 'User',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'gender' => 'male',
                'job' => 'Administrator',
                'adress' => 'Admin Address',
                'password' => Hash::make('adminpassword'), // Make sure to use a strong password
                'is_admin' => true, // Assuming you have an is_admin field to differentiate users
            ]);
        }
    }
}
