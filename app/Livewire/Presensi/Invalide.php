<?php

namespace App\Livewire\Presensi;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Invalide extends Component
{
    public function render()
    {
        $invalide = Http::get('http://client_rfid.test/api/invalide');

        $data = json_decode($invalide);
        $data1 = $data->data ?? [];

        // dd($data);
        return view('livewire.presensi.invalide', compact('data1'));
    }
}
