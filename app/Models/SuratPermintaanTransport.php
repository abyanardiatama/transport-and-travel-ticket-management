<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermintaanTransport extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function suratPerintahKerja()
    {
        return $this->hasOne(SuratPerintahKerja::class);
    }
}
