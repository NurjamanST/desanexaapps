<?php

namespace App\Livewire\Presensi;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class InvalideCreate extends Component
{

    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $response = Http::get("http://client_rfid.test/api/invalide");

        $decoded = json_decode($response);
        $collection = collect($decoded->data ?? []);
        $data2 = $collection->firstWhere('id', $this->id); // cari berdasarkan id

        // dd($this->id, $data2); // cek apakah ketemu

        return view('livewire.presensi.invalide-create', compact('data2'));
    }
}
