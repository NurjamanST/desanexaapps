<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RukunWarga extends Model
{
    protected $primaryKey = 'id_rukunwarga';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id_desa');
    }
}
