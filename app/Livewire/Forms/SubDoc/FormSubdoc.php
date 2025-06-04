<?php

namespace App\Livewire\Forms\SubDoc;

use Livewire\Form;
use App\Models\SubmissionDocument;

class FormSubdoc extends Form
{
    public $tanggal_pengajuan = '';
    public $id_doctype = '';
    public $id_penduduk = '';
    public $status_pengajuan = 'Proses Pengajuan';
    public $file_dokumen = '';
    public $status_unduh = false;
    public $catatan = '';

    public function store(){
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'id_doctype' => 'required',
            'id_penduduk' => 'required',
        ]);

        // // ✅ Simpan ke database
        SubmissionDocument::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Pengajuan Dokumen berhasil dibuat.');
    }
}
