<?php

namespace App\Models;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;

class LaporanPenduduk extends Model
{
    protected $table = 'laporan_penduduk';
    protected $primaryKey = 'id_laporan';
    protected $guarded = [];
    
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }
}
