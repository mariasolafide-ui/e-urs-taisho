<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@taisho.co.id',
            'department' => 'IT',
            'role' => 'admin',
            'password' => Hash::make('Admin12345'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Procurement
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Procurement Staff',
            'email' => 'procurement@taisho.co.id',
            'department' => 'Procurement',
            'role' => 'procurement',
            'password' => Hash::make('Procurement12345'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | EHS
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'EHS Staff',
            'email' => 'ehs@taisho.co.id',
            'department' => 'Mechanical Engineering & EHS',
            'role' => 'ehs',
            'password' => Hash::make('Ehs12345'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Test User',
            'email' => 'user@taisho.co.id',
            'department' => 'IT',
            'role' => 'user',
            'password' => Hash::make('User12345'),
        ]);
    }
}