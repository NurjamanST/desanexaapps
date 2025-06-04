{{-- Modal Form Buat Jenis Dokumen --}}
<flux:modal name="add_users" class="w-full">
    <form wire:submit="saveUsers" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Pengguna</flux:heading>
                <flux:text class="mt-2">Tambahkan Pengguna.</flux:text>
            </div>

            <!-- Name -->
            <flux:input wire:model.live="form.name" label="Nama Pengguna" type="text" autofocus autocomplete="name" placeholder="Nama Pengguna"/>

            <!-- Email Address -->
            <flux:input wire:model.live="form.email" label="Email address" type="email"  autocomplete="email" placeholder="email@desanexaapps.com"/>

            <!-- Password -->
            <flux:input wire:model.live="form.password" label="Password" type="password" autocomplete="new-password" placeholder="Password" viewable/>

            <!-- Confirm Password -->
            <flux:input wire:model="form.password_confirmation" label="Konfirmasi Password" type="password" autocomplete="new-password" placeholder="Konfirmasi Password" viewable/>

            @if (auth()->user()->role === App\Enums\UserRole::Adminapps)
                <!-- Role -->
                <flux:select wire:model.live="form.role" label="Role Pengguna" placeholder="Pilih Role">
                    <option value="kepdesa">Kepala Desa</option>
                    <option value="staffdesa">Staff Desa</option>
                    <option value="rukunwarga">Rukunwarga</option>
                    <option value="penduduk">Penduduk</option>
                </flux:select>
            @endif
            
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                
            @endif


            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
