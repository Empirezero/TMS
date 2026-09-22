<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Konza Admin',
            'email'    => 'admin@konza.go.ke',
            'password' => Hash::make('Incorrect'),
            'role'     => 'system_admin',
        ]);

        User::create([
            'name'     => 'Transport Officer',
            'email'    => 'transport@konza.go.ke',
            'password' => Hash::make('Incorrect'),
            'role'     => 'transport_officer',
        ]);

        User::create([
            'name'     => 'John Driver',
            'email'    => 'driver@konza.go.ke',
            'password' => Hash::make('Incorrect'),
            'role'     => 'driver',
        ]);

        User::create([
            'name'     => 'Jane Staff',
            'email'    => 'staff@konza.go.ke',
            'password' => Hash::make('Incorrect'),
            'role'     => 'staff',
        ]);
    }
}
