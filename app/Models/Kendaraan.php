<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Kendaraan extends Model
{
    protected $guarded = ['id'];
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "kendaraan {$eventName}")
        ->useLogName('kendaran_log')
        ->logOnly(['nama_kendaraan', 'plat_nomor'])
        ->logOnlyDirty();
    }
}