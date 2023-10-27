<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuratPermintaanTiketDinas;

class SuratPermintaanTiketDinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratPermintaanTiketDinas::create([
            'nama_pemohon' => 'Kamala Putri',
            'id_pemohon' => '2',
            'unit' => 'SCI-AKL',
            'email_atasan' => 'atasan1@gmail.com',
            'beban_biaya' => 'PT. ABC',
            'jenis_transportasi' => 'Penerbangan',
            'jenis_kelas' => 'Ekonomi',
            'rute_asal' => 'Jakarta',
            'rute_tujuan' => 'Bandung',
            'tanggal_berangkat' => '2021-10-24',
            'jam_berangkat' => '08:00',
            'perusahaan_angkutan' => 'Lion Air',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => null,
        ]);
        SuratPermintaanTiketDinas::create([
            'nama_pemohon' => 'Anton Sutanto',
            'id_pemohon' => '2',
            'unit' => 'SCI-3',
            'email_atasan' => 'atasan1@gmail.com',
            'beban_biaya' => 'PT. ABC',
            'jenis_transportasi' => 'Kereta Api',
            'jenis_kelas' => 'Bisnis',
            'rute_asal' => 'Semarang',
            'rute_tujuan' => 'Yogyakarta',
            'tanggal_berangkat' => '2021-10-25',
            'jam_berangkat' => '11:00',
            'perusahaan_angkutan' => 'KAI',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => false,
        ]);
        SuratPermintaanTiketDinas::create([
            'nama_pemohon' => 'Agus Riyanto',
            'id_pemohon' => '2',
            'unit' => 'PDO-4',
            'email_atasan' => 'atasan@gmail.com',
            'beban_biaya' => 'PT. ABC',
            'jenis_transportasi' => 'Kapal Laut',
            'jenis_kelas' => 'Ekonomi',
            'rute_asal' => 'Semarang',
            'rute_tujuan' => 'Bali',
            'tanggal_berangkat' => '2021-10-26',
            'jam_berangkat' => '13:00',
            'perusahaan_angkutan' => 'PT. ASD',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => true,
        ]);
    }
}
