<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Demo student account so the User Dashboard can be logged into and
     * tested right away.
     *
     * Login page role: Student
     * Email:            student@edu.bd
     * Password:         student12345
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'student@edu.bd',
            ],
            [
                'name' => 'Al Amin Shawon',
                'student_id' => '242015712',
                'password' => Hash::make('student12345'),
                'phone' => '01712345678',
                'department' => 'CSE',
                'semester' => '6th',
                'address' => 'Chattogram, Bangladesh',
                'role' => 'user',
                'status' => 'Active',
                'member_since' => now()->subMonths(8),
            ]
        );
    }
}
