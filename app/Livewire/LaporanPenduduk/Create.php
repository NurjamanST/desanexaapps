<?php

namespace App\Livewire\LaporanPenduduk;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\LaporanPenduduk\FormLaporan;

class Create extends Component
{

    use WithFileUploads;
    public FormLaporan $form;

    public function saveLapDuk(){
        $this->form->store();
        return redirect()->to('penduduk/laporanpenduduk');
    }
    public function render()
    {
        return view('livewire.laporan-penduduk.create');
    }
}
