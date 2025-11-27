<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create Subadmin User
        User::updateOrCreate(
            ['email' => 'subadmin@example.com'],
            [
                'name' => 'Subadmin User',
                'password' => bcrypt('password'),
                'role' => 'subadmin',
            ]
        );

        // Optional: Create Customer User
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer User',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ]
        );
    }
}
