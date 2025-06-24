<?php

namespace App\Livewire\LaporanPenduduk;

use App\Enums\UserRole;
use Livewire\Component;
use App\Models\Penduduk;
use App\Models\LaporanPenduduk;
use Illuminate\Support\Facades\File;

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
            $this->LaporanPenduduk = LaporanPenduduk::where('id_penduduk', $this->id_penduduk)->get();
        }elseif (auth()->user()->role === UserRole::Kepdesa || auth()->user()->role === UserRole::Staffdesa) {
            $this->LaporanPenduduk = LaporanPenduduk::all();
        }
        return view('livewire.laporan-penduduk.read',[
            'LaporanPenduduk' => $this->LaporanPenduduk,
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
        $type = LaporanPenduduk::findOrFail($id);

        $this->deleteId = $type->id_laporan;
        $this->deleteName = $type->nama_laporan;
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
        $type = LaporanPenduduk::find($this->deleteId);

        if (!$type) {
            session()->flash('error', 'Laporan tidak ditemukan');
            $this->isLoading = false;
            return;
        }


        // Hapus file jika ada
        if ($type->bukti_laporan) {
            $filePath = storage_path('app/public/' . $type->bukti_laporan);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                session()->flash('warning', 'File Laporan tidak ditemukan, tapi record tetap dihapus.');
            }
        }

        // Hapus record
        $type->delete();

        // Flash message
        session()->flash('danger', 'Laporan berhasil dihapus.');

        // Tutup modal
        $this->deleting = false;

        // Reset loading
        $this->isLoading = false;

        // Refresh daftar
        $this->dispatch('refresh-laporan');
    }
}
