<?php

namespace App\Livewire\Forms\Desa;

use Livewire\Form;
use App\Models\Desa;

class FormDesa extends Form
{
    public $id_users = '';
    public $nama_lurah_desa = '';
    public $kecamatan;
    public $kota_kabupaten = '';
    public $provinsi = '';
    public $ttd_kepdes;
    public $nama_kepdes = '';
    public $ttd_sekdes;
    public $nama_sekdes = '';
    public $logo_desa;

    public function store(){
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'id_users' => 'required|unique:desas,id_users',
            'nama_lurah_desa' => 'required|string|max:255|unique:desas,nama_lurah_desa',
            'kecamatan' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'nama_kepdes' => 'required|string|max:255',
            'ttd_kepdes' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_sekdes' => 'required|string|max:255',
            'ttd_sekdes' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_desa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // // 💾 Simpan file jika ada
        if ($this->ttd_kepdes) {
            $validatedData['ttd_kepdes'] = $this->ttd_kepdes->store('images/desa', 'public');
        }
        if ($this->ttd_sekdes) {
            $validatedData['ttd_sekdes'] = $this->ttd_sekdes->store('images/desa', 'public');
        }
        if ($this->logo_desa) {
            $validatedData['logo_desa'] = $this->logo_desa->store('images/desa', 'public');
        }

        // // ✅ Simpan ke database
        Desa::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Desa berhasil dibuat.');
    }
}
