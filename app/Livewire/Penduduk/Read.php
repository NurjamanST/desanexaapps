<?php

namespace App\Livewire\Penduduk;

use Livewire\Component;
use App\Models\Penduduk;
use App\Models\RukunWarga;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public function render()
    {
        $id_desa_in_rw = RukunWarga::get('id_desa');
        return view('livewire.penduduk.read',[
            'penduduk' => Penduduk::orderBy('nik')->get(),
            'userspenduduk' => Auth::user()->where('role', 'penduduk')->get(),
            'datarw' => RukunWarga::get(),
        ]);
    }

    // Edit
    public $editing = false;
    public $editId = null;

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

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    public function edit($id)
    {
        $type = Penduduk::where('id_penduduk', $id)->firstOrFail();

        $this->editId = $type->id_penduduk;
        $this->id_users = $type->id_users;
        $this->nik = $type->nik;
        $this->nama = $type->nama;
        $this->tempat_lahir = $type->tempat_lahir;
        $this->tanggal_lahir = $type->tanggal_lahir;
        $this->kelamin = $type->kelamin;
        $this->no_rt = $type->no_rt;
        $this->id_rukunwarga = $type->id_rukunwarga;
        $this->agama = $type->agama;
        $this->status_perkawinan = $type->status_perkawinan;
        $this->pekerjaan = $type->pekerjaan;
        $this->kewarganegaraan = $type->kewarganegaraan;
        
        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'id_users' => ['required','integer','exists:users,id'],
            'nik' => ['required','string','size:16'],
            'nama' => ['required','string','max:255',],
            'tempat_lahir' => [ 'required', 'string', 'max:100',],
            'tanggal_lahir' => [ 'required', 'date',],
            'kelamin' => [ 'required', 'in:L,P',],
            'no_rt' => [ 'required', 'integer', 'min:1',],
            'id_rukunwarga' => ['required','integer','exists:rukun_wargas,id_rukunwarga',],
            'agama' => ['required','string'],
            'status_perkawinan' => ['required','string'],
            'pekerjaan' => ['required','string','max:255',],
            'kewarganegaraan' => ['required','string','max:255',],
        ]);

        // Update data
        Penduduk::where('id_penduduk', $this->editId)->update($validated);

        session()->flash('warning', 'Penduduk berhasil diperbarui.');
        $this->editing = false;
    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset();
    }

    // Delete
    public function confirmDelete($id_penduduk)
    {
        $type = Penduduk::where('id_penduduk', $id_penduduk)->firstOrFail();


        $this->deleteId = $type->id_penduduk;
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
        $type = Penduduk::find($this->deleteId);


        if (!$type) {
            session()->flash('error', 'Penduduk tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus record
        $type->delete();


        // Flash message
        session()->flash('danger', 'Penduduk berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-rukunwarga-list');
    }
}
