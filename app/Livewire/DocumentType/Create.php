<?php

namespace App\Livewire\DocumentType;

use App\Livewire\Forms\DocumentType\FormDocType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;
    public FormDocType $form;

    public function saveDoctype(){
        $this->form->store();
        return redirect()->to('adminapps/document_type/read');
    }
    public function render()
    {
        return view('livewire.document-type.create');
    }
}
