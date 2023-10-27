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
            $table->string('beban_biaya');
            $table->string('jenis_transportasi');
            $table->string('jenis_kelas');
            $table->string('rute_asal');
            $table->string('rute_tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat');
            $table->string('perusahaan_angkutan');
            // tanggal pembuatan surat diambil dari timestamp
            $table->boolean('isApprove_pegawai')->default(false);
            $table->boolean('isApprove_atasan')->nullable();
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
