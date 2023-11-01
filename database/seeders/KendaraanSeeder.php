<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kendaraan::create([
            'nama_kendaraan' => 'Innova Reborn',
            'plat_nomor' => 'H 1234 AB',
            'status' => 'Tersedia'
        ]);
        Kendaraan::create([
            'nama_kendaraan' => 'Avanza',
            'plat_nomor' => 'H 4567 AB',
            'status' => 'Tersedia'
        ]);
        Kendaraan::create([
            'nama_kendaraan' => 'Xenia',
            'plat_nomor' => 'H 7890 AB',
            'status' => 'Tersedia'
        ]);
        Kendaraan::create([
            'nama_kendaraan' => 'Pajero',
            'plat_nomor' => 'H 2468 AB',
            'status' => 'Tersedia'
        ]);
    }
}
