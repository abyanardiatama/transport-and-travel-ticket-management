<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SuratPermintaanTiketDinas extends Model
{
    protected $guarded = ['id'];
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "surat permintaan tiket dinas {$eventName}")
        ->useLogName('surat_permintaan_tiket_dinas_log')
        ->logOnly(['nama_pemohon', 'unit', 'email_atasan', 'beban_biaya', 'jenis_transportasi', 'jenis_kelas', 'rute_asal', 'rute_tujuan', 'tanggal_berangkat', 'jam_berangkat', 'perusahaan_angkutan', 'isApprove_pegawai', 'isApprove_atasan'])
        ->logOnlyDirty();
    }
}
