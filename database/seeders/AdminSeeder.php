<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@edu.bd',
            ],
            [
                'name' => 'Library Admin',
                
                'password' => Hash::make('admin12345'),
                'phone' => '01734567876',
                'address' => null,
                'role' => 'admin',
                'status' => 'Active',
                'member_since' => now(),
            ]
        );
    }
}