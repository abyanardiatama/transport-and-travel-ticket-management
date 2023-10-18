<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        User::create([
            'name' => 'Admin SCI',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
