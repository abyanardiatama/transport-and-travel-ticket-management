<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_permintaan_tiket_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('id_pemohon');
            $table->string('nama_pemohon');
            $table->string('unit');
            $table->string('email_atasan');
            //berangkat
            $table->string('jenis_transportasi_berangkat');
            $table->string('jenis_kelas_berangkat');
            $table->string('rute_asal_berangkat');
            $table->string('rute_tujuan_berangkat');
            $table->date('tanggal_berangkat');
            $table->string('jam_berangkat');
            $table->string('perusahaan_angkutan_berangkat');

            //pulang
            $table->string('jenis_transportasi_kembali');
            $table->string('jenis_kelas_kembali');
            $table->string('rute_asal_kembali');
            $table->string('rute_tujuan_kembali');
            $table->date('tanggal_kembali');
            $table->string('jam_kembali');
            $table->string('perusahaan_angkutan_kembali');
            
            $table->string('beban_biaya')->nullable();
            // tanggal pembuatan surat diambil dari timestamp
            $table->boolean('isApprove_pegawai')->default(false);
            $table->boolean('isApprove_atasan')->nullable();
            $table->boolean('isApprove_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_permintaan_tiket_dinas');
    }
};
