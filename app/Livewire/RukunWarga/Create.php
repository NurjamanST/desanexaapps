<?php

namespace App\Livewire\RukunWarga;

use App\Models\Desa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\RukunWarga\FormRW;

class Create extends Component
{
    public FormRW $form;
    
    public function saveRW(){
        $this->form->store();
        return redirect()->to('adminapps/kelola_rw/read');
    }
    public function render()
    {
        return view('livewire.rukun-warga.create',[
            'usersrw' => Auth::user()->where('role', 'rukunwarga')->get(),
            'datadesa' => Desa::get()
        ]);
    }
}
