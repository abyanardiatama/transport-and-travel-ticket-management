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
        Schema::create('surat_permintaan_transports', function (Blueprint $table) {
            $table->id();
            $table->string('id_pemohon');
            $table->string('id_admin')->default('-1');
            $table->string('nama_pemohon');
            $table->string('unit');
            $table->string('email_atasan');
            $table->string('tujuan');
            $table->string('rute_pemakaian');
            $table->string('keperluan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->string('jam_berangkat');
            $table->string('jam_kembali');
            $table->string('biaya_perjalanan');
            $table->integer('jumlah_penumpang');
            $table->boolean('isApprove_pegawai')->default(false);
            $table->boolean('isApprove_atasan')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('nama_driver')->nullable();
            $table->string('kendaraan_lain')->nullable();
            $table->boolean('isApprove_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_permintaan_transports');
    }
};
