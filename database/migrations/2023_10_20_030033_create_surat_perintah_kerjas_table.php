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
        Schema::create('surat_perintah_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('id_admin')->default('1');
            $table->foreignId('id_surat_permintaan_transport')->nullable();
            $table->string('nama_driver');
            $table->string('jobdesc');
            $table->string('keperluan');
            $table->string('alamat');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->string('jam_berangkat');
            $table->string('jam_kembali');
            $table->integer('lama_perjalanan');
            $table->boolean('isApprove_admin')->default(false);
            $table->boolean('isApprove_atasan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_kerjas');
    }
};
