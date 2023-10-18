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
        User::create([
            'name' => 'Admin SCI',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_pegawai' => false,
            'is_atasan1' => false,
            'is_atasan2' => false,
            'is_admin' => true,
            'is_driver' => false,
        ]);
        User::create([
            'name' => 'Pegawai SCI',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('password'),
            'is_pegawai' => true,
            'is_atasan1' => false,
            'is_atasan2' => false,
            'is_admin' => false,
            'is_driver' => false,
        ]);
        User::create([
            'name' => 'Atasan 1 SCI',
            'email' => 'atasan1@gmail.com',
            'password' => bcrypt('password'),
            'is_pegawai' => false,
            'is_atasan1' => true,
            'is_atasan2' => false,
            'is_admin' => false,
            'is_driver' => false,
        ]);
        User::create([
            'name' => 'Atasan 2 SCI',
            'email' => 'atasan2@gmail.com',
            'password' => bcrypt('password'),
            'is_pegawai' => false,
            'is_atasan1' => false,
            'is_atasan2' => true,
            'is_admin' => false,
            'is_driver' => false,
        ]);
        User::create([
            'name' => 'Driver SCI',
            'email' => 'driver@gmail.com',
            'password' => bcrypt('password'),
            'is_pegawai' => true,
            'is_atasan1' => false,
            'is_atasan2' => false,
            'is_admin' => false,
            'is_driver' => true,
        ]);
    }
}
