<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionDocument extends Model
{
    protected $table = 'submissiondocuments';
    protected $primaryKey = 'id_subdoc';
    protected $guarded = [];
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }

    public function doctype()
    {
        return $this->belongsTo(Document_type::class, 'id_doctype', 'id');
    }
    
}
