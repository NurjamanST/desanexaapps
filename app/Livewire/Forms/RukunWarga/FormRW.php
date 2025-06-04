<?php

namespace App\Livewire\Forms\RukunWarga;

use Livewire\Form;
use App\Models\RukunWarga;

class FormRW extends Form
{
    public $id_users = '';
    public $id_desa = '';
    public $nama = '';
    public $nama_wilayah = '';
    public $no = '';

    public function store(){
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'id_users' => 'required|unique:rukun_wargas,id_users',
            'id_desa' => 'required|unique:rukun_wargas,id_desa',
            'nama' => 'required|string|max:255|unique:rukun_wargas,nama',
            'nama_wilayah' => 'required|string|max:255|unique:rukun_wargas,nama_wilayah',
            'no' => 'required|string|max:255|unique:rukun_wargas,no',
        ]);

        // // ✅ Simpan ke database
        RukunWarga::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Desa berhasil dibuat.');
    }
}
