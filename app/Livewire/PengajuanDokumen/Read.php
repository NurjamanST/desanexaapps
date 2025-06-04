<?php

namespace App\Livewire\PengajuanDokumen;

use App\Enums\UserRole;
use Livewire\Component;
use App\Models\Penduduk;
use App\Models\SubmissionDocument;
use App\Models\SubmissionRequirement;
use App\Models\Document_type;


class Read extends Component
{
    public $pengajuandokumen = [];
    public $SubmissionDocument = '';

    public function mount()
    {
        if (auth()->user()->role === UserRole::Penduduk) {
            $this->id_login = auth()->user()->id;
            $this->penduduk = Penduduk::where('id_users', $this->id_login)->get('id_penduduk');
            foreach ($this->penduduk as $value) {
                $this->id_penduduk = $value->id_penduduk;
            }
            $this->SubmissionDocument = SubmissionDocument::where('id_penduduk', $this->id_penduduk)->get();
        }else {
            $this->SubmissionDocument = SubmissionDocument::get();
        }
    }

    public function render()
    {
        return view('livewire.pengajuan-dokumen.read',[
            'SubmissionDocument' => $this->SubmissionDocument,
        ]);
    }

    // Edit
    public $Showing = false;
    public $ShowId = null;

    // Data yang ditampilkan di modal
    public $id_penduduk;
    public $id_doctype;
    public $data;
    public $data_doctype;

    public function show($id_subdoc)
    {
        $submissionDoc = SubmissionDocument::where('id_subdoc', $id_subdoc)->firstOrFail();
        $id_penduduk = $submissionDoc->id_penduduk;
        $id_doctype = $submissionDoc->id_doctype;


        $this->data = SubmissionRequirement::where('id_penduduk', $id_penduduk)->get();
        $this->data_doctype = Document_type::where('id', $id_doctype)->get();

        $this->ShowId = $id_subdoc;
        $this->Showing = true;
    }

    public function closeModal()
    {
        $this->Showing = false;
    }

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;

    // Delete
    public function confirmDelete($id_subdoc)
    {
        $type = SubmissionDocument::findOrFail($id_subdoc);

        $this->deleteId = $type->id_subdoc;
        $this->deleteName = $type->penduduk->nama." ".$type->doctype->name;
        $this->deleting = true;
    }
    public function delete()
    {
        $this->isLoading = true;

        // Ambil data dari database
        $type = SubmissionDocument::find($this->deleteId);

        if (!$type) {
            session()->flash('error', 'Berkas Persyaratan tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // // Hapus file jika ada
        // if ($type->file_persyaratan) {
        //     $filePath = storage_path('app/public/' . $type->file_persyaratan);

        //     if (File::exists($filePath)) {
        //         File::delete($filePath);
        //     } else {
        //         session()->flash('warning', 'File Berkas Persyaratan tidak ditemukan, tapi record tetap dihapus.');
        //     }
        // }

        // Hapus record
        $type->delete();

        // Flash message
        session()->flash('danger', 'Pengajuan dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->SubmissionDocument = SubmissionDocument::get();
        $this->reset(['deleteId', 'deleteName']);
    }

    public function closeDeleteModal()
    {
        $this->deleting = false;
        $this->reset(['deleteId', 'deleteName']);
    }
}
