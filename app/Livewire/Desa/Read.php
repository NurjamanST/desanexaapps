<?php

namespace App\Livewire\Desa;

use App\Models\Desa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class Read extends Component
{

    public function render()
    {
        return view('livewire.desa.read',[
            'desas' => Desa::with(['user' => function($query) {$query->where('role', 'kepdesa');}])->latest()->get(),
        ]);
    }
    // Edit
    public $editing = false;
    public $editId = null;
    public $nama_lurah_desa = '';
    public $kecamatan;
    public $kota_kabupaten = '';
    public $provinsi = '';
    public $nama_kepdes = '';
    public $nama_sekdes = '';

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    public function edit($id)
    {
        $type = Desa::where('id_desa', $id)->firstOrFail();

        $this->editId = $type->id_desa;
        $this->nama_lurah_desa = $type->nama_lurah_desa;
        $this->kecamatan = $type->kecamatan;
        $this->kota_kabupaten = $type->kota_kabupaten;
        $this->provinsi = $type->provinsi;
        $this->nama_kepdes = $type->nama_kepdes;
        $this->nama_sekdes = $type->nama_sekdes;

        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'nama_lurah_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'nama_kepdes' => 'required|string|max:255',
            'nama_sekdes' => 'required|string|max:255',
        ]);

        // Update data
        Desa::where('id_desa', $this->editId)->update($validated);

        session()->flash('warning', 'Desa berhasil diperbarui.');
        $this->editing = false;
    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset();
    }

    // Delete
    public function confirmDelete($id_desa)
    {
        // $type = Desa::findOrFail($id_desa);
        $type = Desa::where('id_desa', $id_desa)->firstOrFail();


        $this->deleteId = $type->id_desa;
        $this->deleteName = $type->nama_lurah_desa;
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
        $type = Desa::find($this->deleteId);


        if (!$type) {
            session()->flash('error', 'Desa tidak ditemukan');
            $this->isLoading = false;
            return;
        }

        // Hapus file jika ada
        if ($type->ttd_kepdes) {
            $filePath = storage_path('app/public/' . $type->ttd_kepdes);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File template tidak ditemukan, tapi record tetap dihapus.');
            }
        }
        if ($type->ttd_sekdes) {
            $filePath = storage_path('app/public/' . $type->ttd_sekdes);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File template tidak ditemukan, tapi record tetap dihapus.');
            }
        }
        if ($type->logo_desa) {
            $filePath = storage_path('app/public/' . $type->logo_desa);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File template tidak ditemukan, tapi record tetap dihapus.');
            }
        }


        // Hapus record
        $type->delete();


        // Flash message
        session()->flash('danger', 'Desa & Images berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-desa-list');
    }
}
