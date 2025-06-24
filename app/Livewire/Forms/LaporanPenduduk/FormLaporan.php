<?php

namespace App\Livewire\Forms\LaporanPenduduk;

use Livewire\Form;
use App\Models\Penduduk;
use App\Models\LaporanPenduduk;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class FormLaporan extends Form
{
    public $idlogin;
    public $penduduk;
    public $id_penduduk;
    public $nama_laporan = '';
    public $bukti_laporan;

    public function store()
    {
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'nama_laporan' => 'required|string|max:255',
            'bukti_laporan' => 'required|file|mimes:doc,docx,pdf,png,jpg,jpeg|max:20048',
        ]);

        // 💾 Simpan file jika ada
        if ($this->bukti_laporan) {
            $validatedData['bukti_laporan'] = $this->bukti_laporan->store('file/laporan', 'public'); // ubah supaya d
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
        LaporanPenduduk::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Laporan Penduduk berhasil dibuat...');
    }
}
