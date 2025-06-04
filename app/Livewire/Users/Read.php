<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $users = [];

    public function mount()
    {
        $this->users = Auth::user()->latest("role")->get();
    }

    public function render()
    {
        return view('livewire.users.read',[
            'users' => $this->users
        ]);
    }

    // Edit
    public $editing = false;
    public $editId = null;
    public $name = '';
    public $email = '';

    // Edit
    public function edit($id)
    {
        $type = Auth::user()::where('id', $id)->firstOrFail();
        // Document_type::where('id', $id)->firstOrFail();

        $this->editId = $type->id;
        $this->name = $type->name;
        $this->email = $type->email;
        $this->editing = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        // Update data
        Auth::user()::where('id', $this->editId)->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        session()->flash('warning', 'Pengguna berhasil diperbarui.');
        $this->editing = false;
        $this->mount();

    }

    public function closeModal()
    {
        $this->editing = false;
        $this->reset(['name', 'email', 'editId']);
    }

    // Delete
    public $deleting = false;
    public $deleteId = null;
    public $deleteName = '';
    public $isLoading = false;
    // Delete
    public function confirmDelete($id)
    {
        $type = Auth::user()::findOrFail($id);

        $this->deleteId = $type->id;
        $this->deleteName = $type->name;
        $this->deleting = true;
    }
    public function closeDeleteModal()
    {
        $this->deleting = false;
        $this->reset(['deleteId', 'deleteName']);
    }
    public function delete()
    {
        $this->isLoading = true;

        Auth::user()::where('id', $this->deleteId)->delete();

        session()->flash('danger', 'Pengguna berhasil dihapus.');
        $this->deleting = false;
        $this->isLoading = false;
        $this->reset(['deleteId', 'deleteName']);
        // refesh
        $this->mount();
    }
}
