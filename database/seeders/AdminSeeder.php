<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ecommerce.test',
            'password' => Hash::make('admin@123'), // Change this password in production!
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create a test regular user
    //     User::create([
    //         'name' => 'Test User',
    //         'email' => 'user@ecommerce.test',
    //         'password' => Hash::make('user@123'),
    //         'role' => 'user',
    //         'email_verified_at' => now(),
    //     ]);
    }
}
