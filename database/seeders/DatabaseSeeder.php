<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'dancanngugi79@gmail.com'],
            [
                'name' => 'Dancan Ngugi',
                'password' => Hash::make('incorrect'),
                'role' => 'system_admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
