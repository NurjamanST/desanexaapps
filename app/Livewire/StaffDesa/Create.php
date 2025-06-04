<?php

namespace App\Livewire\StaffDesa;

use App\Models\Desa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\StaffDesa\FormStaff;

class Create extends Component
{
    public FormStaff $form;
    
    public function saveStaffDesa(){
        $this->form->store();
        return redirect()->to('adminapps/kelola_staffdesa/read');
    }
    public function render()
    {
        return view('livewire.staff-desa.create',[
            'usersstaffdesa' => Auth::user()->where('role', 'staffdesa')->get(),
            'datadesa' => Desa::get()
        ]);
    }
}
