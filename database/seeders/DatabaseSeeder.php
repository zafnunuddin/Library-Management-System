<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(LegalPageSeeder::class);
        $this->call(LibraryRulesSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(DemoLibraryActivitySeeder::class);

    }
}
