<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $primaryKey = 'id_penduduk';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function rw()
    {
        return $this->belongsTo(RukunWarga::class, 'id_rukunwarga', 'id_rukunwarga');
    }

    public function submissionrequirements(): HasMany{
        return $this->hasMany(SubmissionRequirement::class, 'id_penduduk');
    }
    
}
