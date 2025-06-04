<?php
namespace App\Livewire\Forms\DocumentType;

use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Document_type;

class FormDocType extends Form
{
    public $name = '';
    public $template_layout;
    public $submission_requirements = '';

    public function store()
    {
        // 🟡 Validasi utama
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'template_layout' => 'required|file|mimes:doc,docx,pdf|max:2048',
            'submission_requirements' => 'required|json',
        ]);

        // 🔍 Parsing JSON submission requirements
        $requirements = json_decode($this->submission_requirements, true);

        if (!is_array($requirements)) {
            // 🔴 Jika JSON tidak valid, set error manual via Livewire
            $this->addError('submission_requirements', 'Harus berupa JSON Array');
            return;
        }

        // 💾 Simpan file jika ada
        if ($this->template_layout) {
            $validatedData['template_layout'] = $this->template_layout->store('templates/document_types', 'public');
        }

        // 📥 Tambahkan user_id secara otomatis
        $validatedData['id_users'] = Auth::id();

        // ✅ Simpan ke database
        Document_type::create($validatedData);

        // ✅ Reset form
        $this->reset();

        // 🎉 Beri notifikasi sukses
        session()->flash('success', 'Jenis dokumen berhasil dibuat.');
    }
}
