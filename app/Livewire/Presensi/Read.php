<?php

namespace App\Livewire\Presensi;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Read extends Component
{
    public function render()
    {
        $data = Http::get('http://client_rfid.test/api/presensi');
        $decoded = json_decode($data);
        $data1 = $decoded->data ?? null;
        $sdm = $decoded->sdm ?? null;

        return view('livewire.presensi.read', compact('data1', 'sdm'));
    }
}
