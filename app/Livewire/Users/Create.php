<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Livewire\Forms\Users\FormUsers;

class Create extends Component
{
    public FormUsers $form;

    public function saveUsers(){
        $this->form->store();
        return redirect()->to('adminapps/kelola_users/read');
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
