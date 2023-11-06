<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SuratPermintaanTransport extends Model
{
    protected $guarded = ['id'];
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "surat permintaan transport {$eventName}")
        ->useLogName('surat_permintaan_transport_log')
        ->logOnly(['nama_pemohon', 'unit', 'email_atasan', 'tujuan', 'rute_pemakaian', 'keperluan', 'tanggal_berangkat', 'tanggal_kembali', 'jam_berangkat', 'jam_kembali', 'biaya_perjalanan', 'jumlah_penumpang', 'isApprove_pegawai', 'isApprove_atasan', 'nomor_polisi', 'nama_driver', 'kendaraan_lain', 'isApprove_admin'])
        ->logOnlyDirty();
    }
    public function suratPerintahKerja()
    {
        return $this->hasOne(SuratPerintahKerja::class);
    }
}
