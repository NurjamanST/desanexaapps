{{-- Modal Form Buat Rukun Warga --}}
<flux:modal name="add_penduduk" class="w-full">
    <form wire:submit="savePenduduk" class="p-6">
        @csrf

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Form Tambah Penduduk</flux:heading>
                <flux:text class="mt-2">Tambahkan Penduduk.</flux:text>
            </div>

            <!-- Buat Select Option ID User (Show Data user dari Tabel Users)-->
            <!-- Pengguna -->
            <flux:select wire:model.live="form.id_users" label="ID Pengguna" placeholder="Pilih Pengguna">
                @foreach($userspenduduk as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </flux:select>
            {{-- NIK --}}
            <flux:input wire:model.live="form.nik" label="NIK Penduduk" type="text"  autocomplete="nik" placeholder="NIK Penduduk"/>
            {{-- Nama --}}
            <flux:input wire:model.live="form.nama" label="Nama Penduduk" type="text"  autocomplete="nama" placeholder="Nama Penduduk"/>
            {{-- TTL --}}
            <flux:input wire:model.live="form.tempat_lahir" label="Tempat Lahir" type="text"  autocomplete="tempat_lahir" placeholder="Tempat Lahir"/>
            <flux:input wire:model.live="form.tanggal_lahir" label="Tanggal Lahir" type="date"  autocomplete="tanggal_lahir" placeholder="Tanggal Lahir"/>
            {{-- Kelamin --}}
            <flux:select wire:model.live="form.kelamin" label="Kelamin" placeholder="Pilih Kelamin">
                <option value="L">{{ __("Laki - Laki") }}</option>
                <option value="P">{{ __("Perempuan") }}</option>
            </flux:select>
            {{-- RT/RW --}}
            <flux:input wire:model.live="form.no_rt" label="No RT" type="number"  autocomplete="no_rt" placeholder="No RT"/>
            <flux:select wire:model.live="form.id_rukunwarga" label="ID Rukun Warga" placeholder="Pilih Rukun Warga">
                @foreach($datarw as $rw)
                    <option value="{{ $rw->id_rukunwarga }}">0{{ $rw->no }} | {{ $rw->nama }} | {{ $rw->nama_wilayah }}</option>
                @endforeach
            </flux:select>
            {{-- Agama --}}
            <flux:select wire:model.live="form.agama" label="Agama" placeholder="Pilih Agama">
                <option value="Islam">{{ __("Islam") }}</option>
                <option value="Kristen(Protestan)">{{ __("Kristen(Protestan)") }}</option>
                <option value="Hindu">{{ __("Hindu") }}</option>
                <option value="Budha">{{ __("Budha") }}</option>
                <option value="Katolik">{{ __("Katolik") }}</option>
                <option value="Konghucu">{{ __("Konghucu") }}</option>
            </flux:select>
            {{-- Status Perkawinan --}}
            <flux:select wire:model.live="form.status_perkawinan" label="Status Perkawinan" placeholder="Pilih Status Perkawinan">
                <option value="Belum Kawin">{{ __("Belum Kawin") }}</option>
                <option value="Kawin">{{ __("Kawin") }}</option>
                <option value="Cerai Hidup">{{ __("Cerai Hidup") }}</option>
                <option value="Cerai Mati">{{ __("Cerai Mati") }}</option>
            </flux:select>
            {{-- Pekerjaan --}}
            <flux:select wire:model.live="form.pekerjaan" label="Pekerjaan"  autocomplete="pekerjaan" placeholder="Pekerjaan">
                <option value="Belum / Tidak Bekerja">{{ __("Belum / Tidak Bekerja") }}</option>
                <option value="Mengurus Rumah Tangga">{{ __("Mengurus Rumah Tangga") }}</option>
                <option value="Pelajar atau Mahasiswa">{{ __("Pelajar atau Mahasiswa") }}</option>
                <option value="Pensiunan">{{ __("Pensiunan") }}</option>
                <option value="PNS">{{ __("PNS") }}</option>
                <option value="TNI">{{ __("TNI") }}</option>
                <option value="Polri">{{ __("Polri") }}</option>
                <option value="Perdagangan">{{ __("Perdagangan") }}</option>
                <option value="Petani">{{ __("Petani") }}</option>
                <option value="Peternak">{{ __("Peternak") }}</option>
                <option value="Nelayan atau Perikanan">{{ __("Nelayan atau Perikanan") }}</option>
                <option value="Industri">{{ __("Industri") }}</option>
                <option value="Konstruksi">{{ __("Konstruksi") }}</option>
                <option value="Transportasi">{{ __("Transportasi") }}</option>
                <option value="Karyawan Swasta">{{ __("Karyawan Swasta") }}</option>
                <option value="Karyawan BUMN">{{ __("Karyawan BUMN") }}</option>
                <option value="BUMD">{{ __("BUMD") }}</option>
                <option value="Karyawan Honorer">{{ __("Karyawan Honorer") }}</option>
                <option value="Buruh Harian Lepas">{{ __("Buruh Harian Lepas") }}</option>
                <option value="Lainnya">{{ __("Lainnya") }}</option>
                {{-- buruh tani atau perkebunan, buruh nelayan atau perikanan, buruh peternakan, pembantu rumah tangga, tukang cukur, tukang listrik, tukang batu, tukang kayu, tukang sol sepatu, tukang las atau pandai besi, tukang jahit, tukang gigi, penata rias, penata busana, penata rambut, mekanik, seniman,tabib, paraji, perancang busana, penerjemah, imam masjid, pendeta, pastor, wartawan --}}
            </flux:select>

            {{-- Kewarganegaraan --}}
            <flux:input wire:model.live="form.kewarganegaraan" label="Kewarganegaraan" type="text"  autocomplete="kewarganegaraan" placeholder="Kewarganegaraan"/>
            <p class="text-sm text-justify dark:text-yellow-400 text-red-500">
                Terkait kolom kewarganegaraan, untuk KTP-el WNI semua kolom kewarganegaraan diisi Indonesia, namun untuk WNA akan disesuaikan kewarganegaraan masing-masing. Misalnya, ditulis Italia, Inggris, Belanda dan lain-lain.
            </p>
            
            <!-- Tombol Submit -->
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="w-full">{{ __("Simpan Data") }}</flux:button>
            </div>

        </div>
    </form>
</flux:modal>
