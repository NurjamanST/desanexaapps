<?php

namespace App\Livewire\Desa;

use App\Models\Desa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\Desa\FormDesa;

class Create extends Component
{
    use WithFileUploads;
    public FormDesa $form;

    public function saveDesa(){
        $this->form->store();
        return redirect()->to('adminapps/kelola_desa/read');
    }
    public function render()
    {
        return view('livewire.desa.create', [
            'userskepdes' => Auth::user()->where('role', 'kepdesa')->get(),
        ]);
    }
}
