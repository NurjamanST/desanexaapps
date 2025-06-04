<?php

namespace App\Livewire\Forms\StaffDesa;

use Livewire\Form;
use App\Models\StaffDesa;

class FormStaff extends Form
{
    public $id_users = '';
    public $id_desa = '';
    public $nama = '';
    public $jabatan = '';

    public function store(){
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'id_users' => 'required|unique:staff_desas,id_users',
            'id_desa' => 'required|unique:staff_desas,id_desa',
            'nama' => 'required|string|max:255|unique:staff_desas,nama',
            'jabatan' => 'required|string|max:255',
        ]);

        // // ✅ Simpan ke database
        StaffDesa::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Desa berhasil dibuat.');
    }
}
