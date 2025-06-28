<?php

namespace App\Livewire\Sdm;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class View extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $data = Http::get('http://client_rfid.test/api/sdm/' . $this->id . '/edit');
        $decoded = json_decode($data);
        $data1 = $decoded->data ?? null;

        $foto_url = $decoded->foto_url ?? null;
        return view('livewire.sdm.view', compact('data1', 'foto_url'));
    }
}
