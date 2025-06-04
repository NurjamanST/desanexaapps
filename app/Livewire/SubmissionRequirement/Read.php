<?php

namespace App\Livewire\SubmissionRequirement;

use App\Enums\UserRole;
use Livewire\Component;
use App\Models\Penduduk;
use Illuminate\Support\Facades\File;
use App\Models\SubmissionRequirement;

class Read extends Component
{
    public function render()
    {
        if (auth()->user()->role === UserRole::Penduduk) {
            $this->id_login = auth()->user()->id;
            $this->penduduk = Penduduk::where('id_users', $this->id_login)->get('id_penduduk');
            foreach ($this->penduduk as $value) {
                $this->id_penduduk = $value->id_penduduk;
            }
            $this->SubmissionRequirement = SubmissionRequirement::where('id_penduduk', $this->id_penduduk)->get();
        }
        return view('livewire.submission-requirement.read',[
            'SubmissionRequirement' => $this->SubmissionRequirement,
        ]);

    }
    
    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    // Delete
    public function confirmDelete($id)
    {
        $type = SubmissionRequirement::findOrFail($id);

        $this->deleteId = $type->id_subreq;
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
        $type = SubmissionRequirement::find($this->deleteId);

        if (!$type) {
            session()->flash('error', 'Berkas Persyaratan tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus file jika ada
        if ($type->file_persyaratan) {
            $filePath = storage_path('app/public/' . $type->file_persyaratan);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File Berkas Persyaratan tidak ditemukan, tapi record tetap dihapus.');
            }
        }

        // Hapus record
        $type->delete();

        // Flash message
        session()->flash('danger', 'Berkas Persyaratan berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-sub-req');
    }
}
