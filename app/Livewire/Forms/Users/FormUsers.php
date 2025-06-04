<?php

namespace App\Livewire\Forms\Users;

use Livewire\Form;
use Illuminate\Support\Facades\Auth;

class FormUsers extends Form
{
    public $name = '';
    public $email;
    public $password = '';
    public $password_confirmation = '';
    public $role = 'penduduk';

    public function store()
    {
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'role' => 'required|string|in:kepdesa,staffdesa,rukunwarga,penduduk', // Contoh role
        ]);
        // 📥 Tambahkan user_id secara otomatis
        // $validatedData['user_id'] = auth()->id();
        $validatedData['user_id'] = Auth::id();

        // ✅ Simpan ke database
        Auth::user()::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Pengguna berhasil ditambahkan.');
    }
}
