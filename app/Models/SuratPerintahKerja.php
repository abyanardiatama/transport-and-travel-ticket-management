<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SuratPerintahKerja extends Model
{
    protected $guarded = ['id'];
    use HasFactory, LogsActivity;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "surat perintah kerja {$eventName}")
        ->useLogName('surat_perintah_kerja_log')
        ->logOnly(['nama_driver', 'jobdesc', 'keperluan', 'alamat', 'tanggal_berangkat', 'tanggal_kembali', 'lama_perjalanan', 'isApprove_admin', 'isApprove_atasan'])
        ->logOnlyDirty();
    }

    public function suratPermintaanTransport()
    {
        return $this->belongsTo(SuratPermintaanTransport::class);
    }
}

