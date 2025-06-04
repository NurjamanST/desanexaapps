<?php

namespace App\Livewire\Penduduk;

use Livewire\Component;
use App\Models\RukunWarga;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\Penduduk\FormPenduduk;

class Create extends Component
{
    public FormPenduduk $form;
    
    public function savePenduduk(){
        $this->form->store();
        return redirect()->to('adminapps/kelola_penduduk/read');
    }
    public function render()
    {
        return view('livewire.penduduk.create',[
            'userspenduduk' => Auth::user()->where('role', 'penduduk')->get(),
            'datarw' => RukunWarga::get()
        ]);
    }
}
