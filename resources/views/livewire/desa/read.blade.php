<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Data Desa') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola Data Desa dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('adminapps.dashboard')">Dasbor</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('adminapps.kelola_desa.read')">Data Desa</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            {{-- Tombol Create Document Type --}}
            <flux:modal.trigger name="add_desas">
                    <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                        <flux:icon.document-plus variant="outline" class="size-5" />
                        Buat Desa
                    </flux:button>
            </flux:modal.trigger>

            <livewire:desa.create />

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
                        <th scope="col" class="px-6 py-3">Identitas Desa</th>
                        <th scope="col" class="px-6 py-3">Kepala Desa</th>
                        <th scope="col" class="px-6 py-3">Sekretaris</th>
                        <th scope="col" class="px-6 py-3">Lambang Desa</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($desas as $desa)
                        {{-- @dd($desa) --}}
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $desa->user?->email ?? 'Tidak diketahui'  }} <br>
                                    {{ $desa->nama_lurah_desa ?? 'Tidak diketahui'  }}
                                    {{ $desa->kecamatan ?? 'Tidak diketahui'  }} <br>
                                    {{ $desa->kota_kabupaten ?? 'Tidak diketahui'  }}
                                    {{ $desa->provinsi ?? 'Tidak diketahui'  }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{-- Tanda Tangan Kepala Desa --}}
                                    @if ($desa->ttd_kepdes)
                                        <img src="{{ asset($desa->ttd_kepdes) }}" alt="Tanda Tangan Kepala Desa" class="w-16 h-16">
                                    @else
                                        <span class="text-gray-500">Tidak ada tanda tangan</span>
                                    @endif
                                    {{-- Nama Kepdes, TTD Kepdes --}}
                                    {{ $desa->nama_kepdes ?? 'Tidak diketahui'  }}
                                </td>
                                <td>
                                    {{-- Tanda Tangan Kepala Desa --}}
                                    @if ($desa->ttd_sekdes)
                                        <img src="{{ asset($desa->ttd_sekdes) }}" alt="Tanda Tangan Sekretaris Desa" class="w-16 h-16">
                                    @else
                                        <span class="text-gray-500">Tidak ada tanda tangan</span>
                                    @endif
                                    {{-- Nama Sekdes, TTD Sekdes --}}
                                    {{ $desa->nama_sekdes ?? 'Tidak diketahui'  }}
                                </td>
                                <td>
                                    {{-- logo --}}
                                    @if ($desa->logo_desa)
                                        {{-- Logo Desa --}}
                                        <img src="{{ asset($desa->logo_desa) }}" alt="Logo Desa" class="w-16 h-16">
                                    @else
                                        <span class="text-gray-500">Tidak ada logo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-2">
                                    <!-- Tombol Edit -->
                                    <flux:button variant="primary" wire:click="edit({{ $desa->id_desa }})" size="sm" class="text-xs">
                                        <flux:icon.pencil-square class="size-5 mr-1" />
                                    </flux:button>
                                    <!-- Tombol Delete -->
                                    <flux:button variant="danger" wire:click="confirmDelete({{ $desa->id_desa }})" size="sm" class="text-xs ml-1">
                                        <flux:icon.x-circle class="size-5 mr-1" />
                                    </flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="4">Data Desa Belum Tersedia, Silahkan tambahkan terlebih dahulu...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Modal Edit -->
                @if ($editing && $editId)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg gap-5">

                            <h2 class="text-lg font-semibold mb-4">Edit Desa</h2>

                            <!-- Name Lurah/Desa-->
                            <flux:input wire:model.live="nama_lurah_desa" label="Nama Kelurahan / Desa" type="text" autofocus autocomplete="nama_lurah_desa" placeholder="Nama Kelurahan / Desa"/>
                            <!-- Kecamatan -->
                            <flux:input wire:model.live="kecamatan" label="Kecamatan" type="text"  autocomplete="kecamatan" placeholder="Kecamatan"/>
                            <!-- Kota/Kabupaten -->
                            <flux:input wire:model.live="kota_kabupaten" label="Kota/Kabupaten" type="text"  autocomplete="kota_kabupaten" placeholder="Kota/Kabupaten"/>
                            <!-- Provinsi -->

                            <flux:input wire:model.live="provinsi" label="Provinsi" type="text"  autocomplete="provinsi" placeholder="Provinsi"/>
                            <!-- Tanda Tangan Kepala Desa -->
                            {{-- <flux:input wire:model.live="ttd_kepdes" label="Tanda Tangan Kepala Desa" type="file" accept="image/*" placeholder="Upload Tanda Tangan Kepala Desa"/> --}}
                            <!-- Nama Kepala Desa -->
                            <flux:input wire:model.live="nama_kepdes" label="Nama Kepala Desa" type="text"  autocomplete="nama_kepdes" placeholder="Nama Kepala Desa"/>
                            <!-- Tanda Tangan Sekretaris Desa -->
                            {{-- <flux:input wire:model.live="ttd_sekdes" label="Tanda Tangan Sekretaris Desa" type="file" accept="image/*" placeholder="Upload Tanda Tangan Sekretaris Desa"/> --}}
                            <!-- Nama Sekretaris Desa --> 
                            <flux:input wire:model.live="nama_sekdes" label="Nama Sekretaris Desa" type="text"  autocomplete="nama_sekdes" placeholder="Nama Sekretaris Desa"/>
                            <!-- Logo Desa --> 
                            {{-- <flux:input wire:model.live="logo_desa" label="Lambang Desa" type="file" accept="image/*" placeholder="Upload Lambang Desa"/> --}}

                            <!-- Tombol Simpan & Batal -->
                            <div class="flex justify-end mt-4 space-x-2">
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

                            <h2 class="text-lg font-semibold mb-4">Hapus Desa?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus Desa berikut?
                                <strong>Tindakan ini tidak bisa dibatalkan.</strong>
                            </p>

                            <div class="font-medium text-red-600 dark:text-red-400 mb-4">
                                {{ $deleteName }}
                            </div>

                            <!-- Loading State (Opsional) -->
                            @if ($this->isLoading)
                                {{-- <flux:spinner class="w-5 h-5 text-blue-500" /> --}}
                                <flux:icon.loading />
                                <span class="ml-2 text-gray-600 dark:text-gray-300">Menghapus desa...</span>
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
