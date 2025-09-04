<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Default email
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'), // Default password
                'role' => 'admin', // 👈 Add this line
            ]
        );
    }
}
