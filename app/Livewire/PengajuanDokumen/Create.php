<?php

namespace App\Livewire\PengajuanDokumen;

use Livewire\Component;
use App\Models\Penduduk;
use App\Models\Document_type;
use App\Livewire\Forms\SubDoc\FormSubdoc;

class Create extends Component
{
    public FormSubdoc $form;
    
    public function saveSubDoc(){
        $this->form->store();
        return redirect()->to('penduduk/pengajuandokumen/read');
    }

    public function render()
    {
        $id_login = auth()->user()->id;
        return view('livewire.pengajuan-dokumen.create',[
            'doctype' => Document_type::get(),
            'penduduk' => Penduduk::where('id_users', $id_login)->get(),
        ]);
    }

}
