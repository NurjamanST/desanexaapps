{{-- Modal Form Buat Rukun Warga --}}
<flux:modal name="add_subdoc" class="w-full">
    <form wire:submit="saveSubDoc" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Rukun Warga</flux:heading>
                <flux:text class="mt-2">Tambahkan Rukun Warga.</flux:text>
            </div>

            <!-- Nama Rukun Warga -->
            {{-- <flux:input wire:model.live="form.nama" label="Nama Rukun Warga" type="text"  autocomplete="nama" placeholder="Nama Rukun Warga"/> --}}
            <!-- Pengguna -->
            <flux:select wire:model.live="form.id_doctype" label="Jenis Dokumen" placeholder="Pilih Jenis Dokumen">
                @foreach($doctype as $doctype)
                    <option value="{{ $doctype->id }}">{{ $doctype->name }}</option>
                @endforeach
            </flux:select>
            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Name Lurah/Desa-->
            <flux:select wire:model.live="form.id_penduduk" label="Penduduk" placeholder="Penduduk">
                @foreach($penduduk as $penduduk)
                    <option value="{{ $penduduk->id_penduduk }}">{{ $penduduk->nik }} | {{ $penduduk->nama }}</option>
                @endforeach
            </flux:select>

            
            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
