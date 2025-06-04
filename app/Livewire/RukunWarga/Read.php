<?php

namespace App\Livewire\RukunWarga;

use Livewire\Component;
use App\Models\RukunWarga;

class Read extends Component
{
    public function render()
    {
        return view('livewire.rukun-warga.read',[
            'rukunwarga' => RukunWarga::latest()->get(),
            // 'rukunwarga' => RukunWarga::with(['user' => function($query) {$query->where('role', 'staffdesa');}])->latest()->get(),
        ]);
    }

    // Edit
    public $editing = false;
    public $editId = null;
    public $nama = '';
    public $nama_wilayah = '';
    public $no = '';

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    public function edit($id)
    {
        $type = RukunWarga::where('id_rukunwarga', $id)->firstOrFail();

        $this->editId = $type->id_rukunwarga;
        $this->nama = $type->nama;
        $this->nama_wilayah = $type->nama_wilayah;
        $this->no = $type->no;
        
        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'nama' => 'required|string|max:255',
            'nama_wilayah' => 'required|string|max:255',
            'no' => 'required|string|max:255',
        ]);

        // Update data
        RukunWarga::where('id_rukunwarga', $this->editId)->update($validated);

        session()->flash('warning', 'Desa berhasil diperbarui.');
        $this->editing = false;
    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset();
    }

    // Delete
    public function confirmDelete($id_rukunwarga)
    {
        $type = RukunWarga::where('id_rukunwarga', $id_rukunwarga)->firstOrFail();


        $this->deleteId = $type->id_rukunwarga;
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
        $type = RukunWarga::find($this->deleteId);


        if (!$type) {
            session()->flash('error', 'Rukun Warga tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus record
        $type->delete();


        // Flash message
        session()->flash('danger', 'Rukun Warga berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-rukunwarga-list');
    }
}
