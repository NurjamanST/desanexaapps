<?php

namespace App\Livewire\Sdm;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Update extends Component
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
        // dd($data1, $foto_url);

        return view('livewire.sdm.update', compact('data1', 'foto_url'));
    }
    // public function render()
    // {
    //     $data = Http::get('http://client_rfid.test/api/sdm');
    //     $decoded = json_decode($data);
    //     $collection = collect($decoded->data ?? []);
    //     $data1 = $collection->firstWhere('id', $this->id);

    //     return view('livewire.sdm.update', compact('data1'));
    // }
}
