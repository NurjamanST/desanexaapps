{{-- Modal Form Buat Rukun Warga --}}
<flux:modal name="add_rw" class="w-full">
    <form wire:submit="saveRW" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Rukun Warga</flux:heading>
                <flux:text class="mt-2">Tambahkan Rukun Warga.</flux:text>
            </div>

            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Pengguna -->
            <flux:select wire:model.live="form.id_users" label="ID Pengguna" placeholder="Pilih Pengguna">
                @foreach($usersrw as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </flux:select>
            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Name Lurah/Desa-->
            <flux:select wire:model.live="form.id_desa" label="ID Desa" placeholder="Pilih Desa">
                @foreach($datadesa as $desa)
                    <option value="{{ $desa->id_desa }}">{{ $desa->nama_lurah_desa }}</option>
                @endforeach
            </flux:select>
            <!-- Nama Rukun Warga -->
            <flux:input wire:model.live="form.nama" label="Nama Rukun Warga" type="text"  autocomplete="nama" placeholder="Nama Rukun Warga"/>
            <!-- Nama Wilayah -->
            <flux:input wire:model.live="form.nama_wilayah" label="Nama Wilayah" type="text"  autocomplete="nama_wilayah" placeholder="Nama Wilayah"/>
            {{-- No RW --}}
            <flux:input wire:model.live="form.no" label="No RW" type="number"  autocomplete="no" placeholder="No RW"/>

            
            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
