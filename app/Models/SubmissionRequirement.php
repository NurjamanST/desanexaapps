<?php

namespace App\Models;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Model;

class SubmissionRequirement extends Model
{
    protected $table = 'submissionrequirements';
    protected $primaryKey = 'id_subreq';
    protected $guarded = [];
    
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }
}
