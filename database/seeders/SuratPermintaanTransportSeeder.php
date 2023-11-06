<?php

namespace Database\Seeders;

use App\Models\SuratPerintahKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuratPermintaanTransport; 

class SuratPermintaanTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratPermintaanTransport::create([
            'nama_pemohon' => 'Pegawai SCI',
            'id_pemohon' => '2',
            'unit' => 'SCI-AKL',
            'email_atasan' => 'atasan1@gmail.com',
            'tujuan' => 'Bandung',
            'rute_pemakaian' => 'Luar Kota',
            'keperluan' => 'Kunjungan Kerja',
            'tanggal_berangkat' => '2021-10-20',
            'tanggal_kembali' => '2021-10-21',
            'jam_berangkat' => '08:00',
            'jam_kembali' => '17:00',
            'biaya_perjalanan' => '100.000',
            'jumlah_penumpang' => '3',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => null,
            'isApprove_admin' => null,
        ]);
        SuratPermintaanTransport::create([
            'nama_pemohon' => 'Anton Sutanto',
            'id_pemohon' => '2',
            'unit' => 'SCI-3',
            'email_atasan' => 'atasan1@gmail.com',
            'tujuan' => 'Yogyakarta',
            'rute_pemakaian' => 'Luar Kota',
            'keperluan' => 'Pengambilan Barang',
            'tanggal_berangkat' => '2021-10-20',
            'tanggal_kembali' => '2021-10-21',
            'jam_berangkat' => '11:00',
            'jam_kembali' => '13:00',
            'biaya_perjalanan' => '300.000',
            'jumlah_penumpang' => '2',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => true,
            'isApprove_admin' => null,
        ]);
        SuratPermintaanTransport::create([
            'nama_pemohon' => 'Pegawai SCI',
            'id_pemohon' => '2',
            'unit' => 'PDO-4',
            'email_atasan' => 'atasan2@gmail.com',
            'tujuan' => 'PT Kimia Firmindo',
            'rute_pemakaian' => 'Dalam Kota',
            'keperluan' => 'Ambil Dokumen',
            'tanggal_berangkat' => '2021-10-25',
            'tanggal_kembali' => '2021-10-25',
            'jam_berangkat' => '13:00',
            'jam_kembali' => '16:00',
            'biaya_perjalanan' => '500.000',
            'jumlah_penumpang' => '4',
            'isApprove_pegawai' => true,
            'isApprove_atasan' => true,
            'nomor_polisi' => 'H 1234 GHI',
            'nama_driver' => 'Driver SCI',
            'isApprove_admin' => true,
        ]);
    }
}
