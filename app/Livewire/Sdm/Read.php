<?php

namespace App\Livewire\Sdm;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Read extends Component
{
    public function render()
    {
        $data = Http::get('http://client_rfid.test/api/sdm');
        $decoded = json_decode($data);
        $data1 = $decoded->data ?? [];

        return view('livewire.sdm.read', compact('data1'));
    }
}
