<?php

namespace App\Livewire\StaffDesa;

use Livewire\Component;
use App\Models\StaffDesa;

class Read extends Component
{
    public function render()
    {
        return view('livewire.staff-desa.read',[
            'staffdesa' => StaffDesa::with(['user' => function($query) {$query->where('role', 'staffdesa');}])->latest()->get(),
        ]);
    }

    // Edit
    public $editing = false;
    public $editId = null;
    public $nama = '';
    public $jabatan = '';

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    public function edit($id)
    {
        $type = StaffDesa::where('id_staff', $id)->firstOrFail();

        $this->editId = $type->id_staff;
        $this->nama = $type->nama;
        $this->jabatan = $type->jabatan;
        
        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        // Update data
        StaffDesa::where('id_staff', $this->editId)->update($validated);

        session()->flash('warning', 'Desa berhasil diperbarui.');
        $this->editing = false;
    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset();
    }

    // Delete
    public function confirmDelete($id_staff)
    {
        $type = StaffDesa::where('id_staff', $id_staff)->firstOrFail();


        $this->deleteId = $type->id_staff;
        $this->deleteName = $type->nama;
        $this->deleting = true;
    }
    public function closeDeleteModal()
    {
        $this->deleting = false;
        $this->reset();
    }
    public function delete()
    {
        $this->isLoading = true;
        $type = StaffDesa::find($this->deleteId);


        if (!$type) {
            session()->flash('error', 'Desa tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus record
        $type->delete();


        // Flash message
        session()->flash('danger', 'Staff Desa berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-staffdesa-list');
    }
}
