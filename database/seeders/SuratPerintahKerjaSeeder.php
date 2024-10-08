<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuratPerintahKerja;

class SuratPerintahKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratPerintahKerja::create([
            'nama_driver' => 'Driver SCI',
            'id_surat_permintaan_transport' => '3',
            'jobdesc' => 'Driver',
            'keperluan' => 'Ambil Dokumen',
            'alamat' => 'PT Kimia Firmindo',
            'nomor_polisi' => 'H 1234 GHI',
            'tanggal_berangkat' => '2021-10-25',
            'tanggal_kembali' => '2021-10-25',
            'jam_berangkat' => '13:00',
            'jam_kembali' => '16:00',
            'lama_perjalanan' => 1,
            'isApprove_admin' => true,
            'isApprove_atasan' => true,
        ]);
        // SuratPerintahKerja::create([
        //     'nama_driver' => 'Rudi Prasetyo',
        //     'jobdesc' => 'Mengantar Dokumen',
        //     'keperluan' => 'Ambil Dokumen',
        //     'alamat' => 'Jl. Raya Semarang',
        //     'tanggal_berangkat' => '2021-10-20',
        //     'tanggal_kembali' => '2021-10-21',
        //     'lama_perjalanan' => 1,
        //     'isApprove_admin' => true,
        //     'isApprove_atasan' => true,
        // ]);
        // SuratPerintahKerja::create([
        //     'nama_driver' => 'Agus Riyanto',
        //     'jobdesc' => 'Mengantar Dokumen',
        //     'keperluan' => 'Ambil Dokumen',
        //     'alamat' => 'Jl. Raya Semarang',
        //     'tanggal_berangkat' => '2021-10-20',
        //     'tanggal_kembali' => '2021-10-21',
        //     'lama_perjalanan' => 1,
        //     'isApprove_admin' => true,
        //     'isApprove_atasan' => true,
        // ]);
        // SuratPerintahKerja::create([
        //     'nama_driver' => 'Budi Santoso',
        //     'id_surat_permintaan_transport' => null,
        //     'jobdesc' => 'Driver',
        //     'keperluan' => 'Ambil Dokumen',
        //     'alamat' => 'Ambil Dokumen',
        //     'tanggal_berangkat' => '2021-10-25',
        //     'tanggal_kembali' => '2021-10-25',
        //     'lama_perjalanan' => 1,
        //     'isApprove_admin' => true,
        //     'isApprove_atasan' => true,
        // ]);
    }
}
