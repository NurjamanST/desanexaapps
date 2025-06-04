<?php

namespace App\Livewire\SubmissionRequirement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\SubReq\FormSubreq;

class Create extends Component
{

    use WithFileUploads;
    public FormSubreq $form;

    public function saveSubReq(){
        $this->form->store();
        return redirect()->to('penduduk/uploadpersyaratan');
    }
    public function render()
    {
        return view('livewire.submission-requirement.create');
    }
}
