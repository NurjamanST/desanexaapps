<?php

namespace App\Livewire\Forms\Penduduk;

use Livewire\Form;
use App\Models\Penduduk;

class FormPenduduk extends Form
{

    public $id_users = '';
    public $nik = '';
    public $nama = '';
    public $tempat_lahir = '';
    public $tanggal_lahir = '';
    public $kelamin = '';
    public $no_rt = '';
    public $id_rukunwarga  = '';
    public $agama = '';
    public $status_perkawinan = '';
    public $pekerjaan = '';
    public $kewarganegaraan = '';

    public function store(){
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'id_users' => ['required','integer','exists:users,id','unique:penduduks,id_users',],
            'nik' => ['required','string','size:16','unique:penduduks,nik',],
            'nama' => ['required','string','max:255',],
            'tempat_lahir' => [ 'required', 'string', 'max:100',],
            'tanggal_lahir' => [ 'required', 'date',],
            'kelamin' => [ 'required', 'in:L,P',],
            'no_rt' => [ 'required', 'integer', 'min:1',],
            'id_rukunwarga' => ['required','integer','exists:rukun_wargas,id_rukunwarga',],
            'agama' => ['required','string'],
            'status_perkawinan' => ['required','string'],
            'pekerjaan' => ['required','string','max:255',],
            'kewarganegaraan' => ['required','string','max:255'],
        ]);

        // // ✅ Simpan ke database
        Penduduk::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Desa berhasil dibuat.');
    }
}
