<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Data Penduduk') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data Penduduk dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('adminapps.dashboard')">Dasbor</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('adminapps.kelola_penduduk.read')">Data Penduduk</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            {{-- Tombol Create Document Type --}}
            <flux:modal.trigger name="add_penduduk">
                <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                    <flux:icon.document-plus variant="outline" class="size-5" />
                    Buat Penduduk
                </flux:button>
            </flux:modal.trigger>

            <livewire:penduduk.create />

            <div class="overflow-x-auto my-5">
                @if (session()->has('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md dark:bg-green-900 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('warning'))
                    <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-md dark:bg-yellow-900 dark:text-yellow-200">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session()->has('danger'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md dark:bg-red-900 dark:text-red-200">
                        {{ session('danger') }}
                    </div>
                @endif
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Penduduk</th>
                        <th scope="col" class="px-6 py-3" colspan="1">Details</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($penduduk as $data)
                        {{-- @dd($desa) --}}
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    <table>
                                        <tr>
                                            <td>Alamat Email</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->user?->email ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->nik ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->nama ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->tempat_lahir ?? 'Tidak diketahui' }}, {{ $data->tanggal_lahir ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelamin</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->kelamin == 'L' ? 'Laki - Laki' : ($data->kelamin == 'P' ? 'Perempuan' : 'Tidak diketahui') }}</td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    <table>
                                        <tr>
                                            <td>RT/RW</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>0{{ $data->no_rt ?? 'Tidak diketahui' }} / 0{{ $data->rw?->no ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        @php
                                            $desa = App\Models\Desa::where('id_desa', $data->rw?->id_desa)->get()
                                        @endphp
                                        <tr>
                                            <td>Kel/Desa</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->rw?->id_desa ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $desa->kecamatan ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kab/Kota</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->pekerjaan ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->kewarganegaraan == 'L' ? 'Laki - Laki' : ($data->kelamin == 'P' ? 'Perempuan' : 'Tidak diketahui') }}</td>
                                        </tr>
                                    </table>
                                </td>    --}}
                                <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    <table>
                                        <tr>
                                            <td>RT/RW</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>0{{ $data->no_rt ?? 'Tidak diketahui' }} / 0{{ $data->rw?->no ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->agama ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Perkawinan</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->status_perkawinan ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->pekerjaan ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kewarganegaraan</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td>{{ $data->kewarganegaraan ?? 'Tidak diketahui' }}</td>
                                        </tr>
                                    </table>
                                </td>                                                                
                                <td class="px-6 py-2">
                                    <!-- Tombol Edit -->
                                    <flux:button variant="primary" wire:click="edit({{ $data->id_penduduk }})" size="sm" class="text-xs">
                                        <flux:icon.pencil-square class="size-5 mr-1" />
                                    </flux:button>
                                    <!-- Tombol Delete -->
                                    <flux:button variant="danger" wire:click="confirmDelete({{ $data->id_penduduk }})" size="sm" class="text-xs ml-1">
                                        <flux:icon.x-circle class="size-5 mr-1" />
                                    </flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="6">Data Rukun Warga Belum Tersedia, Silahkan tambahkan terlebih dahulu...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Modal Edit -->
                @if ($editing && $editId)
                    <!-- Modal Utama -->
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-7xl shadow-lg gap-5 mx-4 animate-fadeIn">

                            <!-- Judul -->
                            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Edit Penduduk</h2>

                            <!-- Form Grid Dua Kolom -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <flux:select wire:model.live="id_users" label="ID Pengguna" placeholder="Pilih Pengguna">
                                    @foreach($userspenduduk as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </flux:select>
                                <!-- NIK -->
                                <flux:input wire:model.live="nik" label="NIK Penduduk" type="text" autocomplete="nik" placeholder="NIK Penduduk"/>

                                <!-- Nama -->
                                <flux:input wire:model.live="nama" label="Nama Penduduk" type="text" autocomplete="nama" placeholder="Nama Penduduk"/>

                                <!-- Tempat Lahir -->
                                <flux:input wire:model.live="tempat_lahir" label="Tempat Lahir" type="text" autocomplete="tempat_lahir" placeholder="Tempat Lahir"/>

                                <!-- Tanggal Lahir -->
                                <flux:input wire:model.live="tanggal_lahir" label="Tanggal Lahir" type="date" autocomplete="tanggal_lahir"/>

                                <!-- Kelamin -->
                                <flux:select wire:model.live="kelamin" label="Kelamin" placeholder="Pilih Kelamin">
                                    <option value="L">{{ __("Laki - Laki") }}</option>
                                    <option value="P">{{ __("Perempuan") }}</option>
                                </flux:select>
                                {{-- RT/RW --}}
                                <flux:input wire:model.live="no_rt" label="No RT" type="number"  autocomplete="no_rt" placeholder="No RT"/>
                                <flux:select wire:model.live="id_rukunwarga" label="ID Rukun Warga" placeholder="Pilih Rukun Warga">
                                    @foreach($datarw as $rw)
                                        <option value="{{ $rw->id_rukunwarga }}">0{{ $rw->no }} | {{ $rw->nama }} | {{ $rw->nama_wilayah }}</option>
                                    @endforeach
                                </flux:select>

                                <!-- Agama -->
                                <flux:select wire:model.live="agama" label="Agama" placeholder="Pilih Agama">
                                    <option value="Islam">{{ __("Islam") }}</option>
                                    <option value="Kristen(Protestan)">{{ __("Kristen(Protestan)") }}</option>
                                    <option value="Hindu">{{ __("Hindu") }}</option>
                                    <option value="Budha">{{ __("Budha") }}</option>
                                    <option value="Katolik">{{ __("Katolik") }}</option>
                                    <option value="Konghucu">{{ __("Konghucu") }}</option>
                                </flux:select>

                                <!-- Status Perkawinan -->
                                <flux:select wire:model.live="status_perkawinan" label="Status Perkawinan" placeholder="Pilih Status Perkawinan">
                                    <option value="Belum Kawin">{{ __("Belum Kawin") }}</option>
                                    <option value="Kawin">{{ __("Kawin") }}</option>
                                    <option value="Cerai Hidup">{{ __("Cerai Hidup") }}</option>
                                    <option value="Cerai Mati">{{ __("Cerai Mati") }}</option>
                                </flux:select>

                                <!-- Pekerjaan -->
                                <flux:select wire:model.live="pekerjaan" label="Pekerjaan" autocomplete="pekerjaan" placeholder="Pekerjaan">
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
                                </flux:select>

                                <!-- Kewarganegaraan -->
                                <flux:input wire:model.live="kewarganegaraan" label="Kewarganegaraan" type="text" autocomplete="kewarganegaraan" placeholder="Kewarganegaraan"/>

                            </div>

                            <!-- Deskripsi Kewarganegaraan -->
                            <div class="mt-4">
                                <p class="text-xs text-justify text-red-500 dark:text-yellow-400">
                                    Terkait kolom kewarganegaraan, untuk KTP-el WNI semua kolom kewarganegaraan diisi Indonesia, namun untuk WNA akan disesuaikan kewarganegaraan masing-masing. Misalnya, ditulis Italia, Inggris, Belanda dan lain-lain.
                                </p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex justify-end mt-6 space-x-3">
                                <flux:button wire:click="closeModal" variant="filled" size="sm">Batal</flux:button>
                                <flux:button wire:click="update" variant="primary" size="sm">Simpan Perubahan</flux:button>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Modal Delete -->
                @if ($deleting && $deleteId)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Hapus Penduduk?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus Penduduk berikut?
                                <strong>Tindakan ini tidak bisa dibatalkan.</strong>
                            </p>

                            <div class="font-medium text-red-600 dark:text-red-400 mb-4">
                                {{ $deleteName }}
                            </div>

                            @if ($this->isLoading)
                                <flux:icon.loading />
                                <span class="ml-2 text-gray-600 dark:text-gray-300">Menghapus penduduk...</span>
                            @else
                                <div class="flex justify-end space-x-2">
                                    <flux:button wire:click="closeDeleteModal" variant="filled" size="sm">Batal</flux:button>
                                    <flux:button wire:click="delete" variant="danger" size="sm">Ya, Hapus</flux:button>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>