<?php

namespace App\Livewire\PengajuanDokumen;

use App\Enums\UserRole;
use Livewire\Component;
use App\Models\Penduduk;
use App\Models\Document_type;
use Livewire\WithFileUploads;
use App\Models\SubmissionDocument;
use App\Models\SubmissionRequirement;


class Read extends Component
{
    use WithFileUploads;
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
        } elseif (auth()->user()->role === UserRole::Staffdesa) {
            $this->SubmissionDocument = SubmissionDocument::get();
        } elseif (auth()->user()->role === UserRole::Kepdesa) {
            $this->SubmissionDocument = SubmissionDocument::whereIn('status_pengajuan', ['Ditinjau Kepdes', 'Accept Kepdes'])->get();
        } elseif (auth()->user()->role === UserRole::Rukunwarga) {
            $this->SubmissionDocument = SubmissionDocument::get();
        } else {
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
    public $updating = false;

    // Data yang ditampilkan di modal
    public $id_penduduk;
    public $id_doctype;
    public $data;
    public $data_doctype;
    public $data_subdoc;

    // Form Penolakan
    public $showRejectForm = false;
    public $rejectIdSubdoc = null;
    public $rejectKepdesIdSubdoc = null;
    public $catatan_penolakan = '';

    // Upload
    public $uploading = false;
    public $uploadIdSubdoc = null;
    public $file_dokumen;

    // Accept
    public $accepting = false;
    public $acceptIdSubdoc = null;
    public $acceptName = '';

    public function show($id_subdoc)
    {
        $submissionDoc = SubmissionDocument::where('id_subdoc', $id_subdoc)->firstOrFail();
        $id_penduduk = $submissionDoc->id_penduduk;
        $id_doctype = $submissionDoc->id_doctype;


        $this->data_subdoc = SubmissionDocument::where('id_subdoc', $id_subdoc)->get();
        $this->data = SubmissionRequirement::where('id_penduduk', $id_penduduk)->get();
        $this->data_doctype = Document_type::where('id', $id_doctype)->get();

        $this->ShowId = $id_subdoc;
        $this->Showing = true;
    }

    public function verifySubdoc($id_subdoc)
    {
        // Ambil satu record berdasarkan id_subdoc
        $subdoc = SubmissionDocument::where('id_subdoc', $id_subdoc)->first();

        if ($subdoc) {
            // Update status_pengajuan menjadi "Diverifikasi Staff Desa"
            $subdoc->update([
                'status_pengajuan' => 'Diverifikasi Staff Desa',
                'catatan' => null, // Kosongkan catatan jika sebelumnya ditolak
            ]);

            // Flash message
            session()->flash('message', 'Pengajuan berhasil diverifikasi.');

            // Tutup modal
            $this->Showing = false;

            // Refresh daftar
            $this->SubmissionDocument = SubmissionDocument::get();
            $this->reset(['ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan']);
        } else {
            session()->flash('error', 'Gagal menemukan data pengajuan.');
        }
    }

    public function resubmitSubdoc($id_subdoc)
    {
        // Ambil satu record berdasarkan id_subdoc
        $subdoc = SubmissionDocument::where('id_subdoc', $id_subdoc)->first();

        if ($subdoc) {
            // Update status_pengajuan menjadi "Diverifikasi Staff Desa"
            $subdoc->update([
                'status_pengajuan' => 'Proses Pengajuan',
                'catatan' => null, // Kosongkan catatan jika sebelumnya ditolak
            ]);

            // Flash message
            session()->flash('message', 'Pengajuan berhasil dikirim ulang.');

            // Tutup modal
            $this->Showing = false;

            // Refresh daftar
            $this->SubmissionDocument = SubmissionDocument::get();
            $this->reset(['ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan']);
        } else {
            session()->flash('error', 'Gagal menemukan data pengajuan.');
        }
    }

    public function setRejectId($id_subdoc)
    {
        $this->rejectIdSubdoc = $id_subdoc;
        $this->showRejectForm = true;
    }

    public function rejectSubdoc()
    {
        $this->validate([
            'catatan_penolakan' => 'required|string|max:500',
        ]);

        $subdoc = SubmissionDocument::where('id_subdoc', $this->rejectIdSubdoc)->first();

        if ($subdoc) {
            $subdoc->update([
                'status_pengajuan' => 'Reject Staff Desa',
                'catatan' => $this->catatan_penolakan,
            ]);

            session()->flash('message', 'Pengajuan berhasil Reject Staff Desa.');

            // Refresh daftar
            $this->SubmissionDocument = SubmissionDocument::get();
            $this->Showing = false;
            $this->reset(['ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan']);
        } else {
            session()->flash('error', 'Gagal menemukan data pengajuan.');
        }
    }

    public function setRejectKepdesId($id_subdoc)
    {
        $this->rejectKepdesIdSubdoc = $id_subdoc;
        $this->showRejectForm = true;
    }

    public function rejectKepdesSubdoc()
    {
        $this->validate([
            'catatan_penolakan' => 'required|string|max:500',
        ]);

        $subdoc = SubmissionDocument::where('id_subdoc', $this->rejectKepdesIdSubdoc)->first();

        if ($subdoc) {
            $subdoc->update([
                'status_pengajuan' => 'Reject Kepdes',
                'catatan' => $this->catatan_penolakan,
            ]);

            session()->flash('message', 'Pengajuan berhasil Reject Kepala Desa.');

            // Refresh daftar
            $this->SubmissionDocument = SubmissionDocument::get();
            $this->Showing = false;
            $this->reset(['ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan']);
        } else {
            session()->flash('error', 'Gagal menemukan data pengajuan.');
        }
    }
    public function uploadFile($id_subdoc)
    {
        $this->uploadIdSubdoc = $id_subdoc;
        $this->uploading = true;
    }
    public function uploadFileDokumen()
    {
        // Validasi file
        $this->validate([
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048', // Maksimal 2MB
        ]);
    
        // Cek apakah file dokumen memiliki ekstensi yang didukung
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $extension = $this->file_dokumen->getClientOriginalExtension();
        if (!in_array($extension, $allowedExtensions)) {
            session()->flash('danger', 'Ekstensi file tidak didukung. Hanya file PDF, DOC, dan DOCX yang diperbolehkan.');
            $this->uploading = false;
            return;
        }


        // Ambil data subdoc berdasarkan ID
        $subdoc = SubmissionDocument::find($this->uploadIdSubdoc);

        if (!$subdoc) {
            session()->flash('danger', 'File Dokumen tidak ditemukan');
            return;
        }

        // Simpan file dan update data
        $subdoc->update([
            'file_dokumen' => $this->file_dokumen->store('file/submissiondoc', 'public'),
            'status_pengajuan' => 'Ditinjau Kepdes',
            'catatan' => null,
        ]);

        // Tampilkan notifikasi sukses
        session()->flash('success', 'File berhasil diunggah, Pengajuan akan ditinjau oleh Kepala Desa.');

        // Reset state

        $this->uploading = false;
        $this->SubmissionDocument = SubmissionDocument::get();
        $this->reset(['uploadIdSubdoc', 'file_dokumen']);
    }

    public function acceptSubdoc($id_subdoc)
    {
        $this->acceptIdSubdoc = $id_subdoc;
        $this->accepting = true;
        // Ambil data subdoc berdasarkan ID
        $subdoc = SubmissionDocument::find($this->acceptIdSubdoc);
        $this->acceptName = $subdoc->penduduk->nama . " " . $subdoc->doctype->name;
    }

    public function accept()
    {
        // Ambil data subdoc berdasarkan ID
        $subdoc = SubmissionDocument::find($this->acceptIdSubdoc);

        if (!$subdoc) {
            session()->flash('error', 'Pengajuan tidak ditemukan.');
            return;
        }

        // Update status_pengajuan menjadi "Diterima"
        $subdoc->update([
            'status_pengajuan' => 'Accept Kepdes',
            'catatan' => null, // Kosongkan catatan jika sebelumnya ditolak
        ]);

        // Tampilkan notifikasi sukses
        session()->flash('success', 'Pengajuan berhasil diterima.');

        // Tutup modal
        $this->accepting = false;

        // Refresh daftar
        $this->SubmissionDocument = SubmissionDocument::whereIn('status_pengajuan', ['Ditinjau Kepdes', 'Accept Kepdes'])->get();
        $this->reset(['acceptIdSubdoc', 'acceptName', 'Showing', 'ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan', 'rejectIdSubdoc', 'rejectKepdesIdSubdoc', 'uploadIdSubdoc', 'file_dokumen', 'uploading']);
    }

    public function closeModal()
    {
        $this->Showing = false;
        $this->reset(['ShowId', 'data', 'data_doctype', 'data_subdoc', 'showRejectForm', 'catatan_penolakan', 'rejectIdSubdoc', 'rejectKepdesIdSubdoc', 'uploadIdSubdoc', 'file_dokumen', 'uploading', 'updating', 'deleting', 'deleteId', 'deleteName', 'accepting', 'acceptIdSubdoc']);
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
