{{-- Modal Form Buat Jenis Dokumen --}}
<flux:modal name="add_staffdesas" class="w-full">
    <form wire:submit="saveStaffDesa" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Staff Desa</flux:heading>
                <flux:text class="mt-2">Tambahkan Staff Desa.</flux:text>
            </div>

            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Pengguna -->
            <flux:select wire:model.live="form.id_users" label="ID Pengguna" placeholder="Pilih Pengguna">
                @foreach($usersstaffdesa as $user)
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
            <!-- Nama Staff Desa -->
            <flux:input wire:model.live="form.nama" label="Nama Staff Desa" type="text"  autocomplete="nama" placeholder="Nama Staff Desa"/>
            <!-- Jabatan -->
            <flux:input wire:model.live="form.jabatan" label="Jabatan" type="text"  autocomplete="jabatan" placeholder="Jabatan"/>
            
            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
