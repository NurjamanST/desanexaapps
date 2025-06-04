{{-- Modal Form Buat Jenis Dokumen --}}
<flux:modal name="add_desas" class="w-full">
    <form wire:submit="saveDesa" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Desa</flux:heading>
                <flux:text class="mt-2">Tambahkan Pengguna.</flux:text>
            </div>

            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Pengguna -->
            <flux:select wire:model.live="form.id_users" label="ID Pengguna" placeholder="Pilih Pengguna">
                @foreach($userskepdes as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </flux:select>
            <!-- Name Lurah/Desa-->
            <flux:input wire:model.live="form.nama_lurah_desa" label="Nama Kelurahan / Desa" type="text" autofocus autocomplete="nama_lurah_desa" placeholder="Nama Kelurahan / Desa"/>
            <!-- Kecamatan -->
            <flux:input wire:model.live="form.kecamatan" label="Kecamatan" type="text"  autocomplete="kecamatan" placeholder="Kecamatan"/>
            <!-- Kota/Kabupaten -->
            <flux:input wire:model.live="form.kota_kabupaten" label="Kota/Kabupaten" type="text"  autocomplete="kota_kabupaten" placeholder="Kota/Kabupaten"/>
            <!-- Provinsi -->
            <flux:input wire:model.live="form.provinsi" label="Provinsi" type="text"  autocomplete="provinsi" placeholder="Provinsi"/>
            <!-- Tanda Tangan Kepala Desa -->
            <flux:input wire:model.live="form.ttd_kepdes" label="Tanda Tangan Kepala Desa" type="file" accept="image/*" placeholder="Upload Tanda Tangan Kepala Desa"/>
            <!-- Nama Kepala Desa -->
            <flux:input wire:model.live="form.nama_kepdes" label="Nama Kepala Desa" type="text"  autocomplete="nama_kepdes" placeholder="Nama Kepala Desa"/>
            <!-- Tanda Tangan Sekretaris Desa -->
            <flux:input wire:model.live="form.ttd_sekdes" label="Tanda Tangan Sekretaris Desa" type="file" accept="image/*" placeholder="Upload Tanda Tangan Sekretaris Desa"/>
            <!-- Nama Sekretaris Desa --> 
            <flux:input wire:model.live="form.nama_sekdes" label="Nama Sekretaris Desa" type="text"  autocomplete="nama_sekdes" placeholder="Nama Sekretaris Desa"/>
            <!-- Logo Desa --> 
            <flux:input wire:model.live="form.logo_desa" label="Lambang Desa" type="file" accept="image/*" placeholder="Upload Lambang Desa"/>

            
            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
