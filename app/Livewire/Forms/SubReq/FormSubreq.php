<?php

namespace App\Livewire\Forms\SubReq;

use Livewire\Form;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;
use App\Models\SubmissionRequirement;

class FormSubreq extends Form
{
    public $idlogin;
    public $penduduk;
    public $id_penduduk;
    public $name = '';
    public $file_persyaratan;

    public function store()
    {
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'file_persyaratan' => 'required|file|mimes:doc,docx,pdf,png,jpg,jpeg|max:2048',
        ]);

        // 💾 Simpan file jika ada
        if ($this->file_persyaratan) {
            $validatedData['file_persyaratan'] = $this->file_persyaratan->store('file/submissionreq', 'public');
        }

        // Ambil ID user yang login
        $this->idlogin = Auth::id();

        // Ambil data penduduk berdasarkan id_users
        $this->penduduk = Penduduk::where('id_users', $this->idlogin)->first();

        // Ekstrak id_penduduk jika data ditemukan
        $this->id_penduduk = $this->penduduk ? $this->penduduk->id_penduduk : null;

        // 📥 Tambahkan id Penduduk secara otomatis
        $validatedData['id_penduduk'] = $this->id_penduduk;

        // ✅ Simpan ke database
        SubmissionRequirement::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Berkas Persyaratan berhasil dibuat...');
    }
}
