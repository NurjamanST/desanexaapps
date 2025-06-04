<?php

namespace App\Livewire\DocumentType;

use Livewire\Component;
use App\Models\Document_type;
use Illuminate\Support\Facades\File;



class Read extends Component
{
    public function render()
    {
        return view('livewire.document-type.read',[
            'documen_type' => auth()->user()->document_type()->latest()->get()
        ]);
    }

    // Edit
    public $editing = false;
    public $editId = null;
    public $name = '';
    public $submission_requirements = '';

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    public function edit($id)
    {
        $type = Document_type::where('id', $id)->firstOrFail();

        $this->editId = $type->id;
        $this->name = $type->name;
        $this->submission_requirements = $type->submission_requirements;

        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'submission_requirements' => 'required|json'
        ]);

        // Parsing JSON
        $requirements = json_decode($this->submission_requirements, true);
        if (!is_array($requirements)) {
            $this->addError('submission_requirements', 'Harus berupa JSON Array valid');
            return;
        }

        // Update data
        Document_type::where('id', $this->editId)->update([
            'name' => $this->name,
            'submission_requirements' => $this->submission_requirements
        ]);

        session()->flash('warning', 'Jenis dokumen berhasil diperbarui.');
        $this->editing = false;
    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset(['name', 'submission_requirements', 'editId']);
    }

    // Delete
    public function confirmDelete($id)
    {
        $type = Document_type::findOrFail($id);

        $this->deleteId = $type->id;
        $this->deleteName = $type->name;
        $this->deleting = true;
    }
    public function closeDeleteModal()
    {
        $this->deleting = false;
        $this->reset(['deleteId', 'deleteName']);
    }
    public function delete()
    {
        $this->isLoading = true;

        // Ambil data dari database
        $type = Document_type::find($this->deleteId);

        if (!$type) {
            session()->flash('error', 'Jenis dokumen tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus file jika ada
        if ($type->template_layout) {
            $filePath = storage_path('app/public/' . $type->template_layout);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File template tidak ditemukan, tapi record tetap dihapus.');
            }
        }

        // Hapus record
        $type->delete();

        // Flash message
        session()->flash('danger', 'Jenis dokumen & template berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-document-types');
    }
}
