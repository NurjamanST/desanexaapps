<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Laporan Penduduk') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data laporan penduduk dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('kepdesa.laporanpenduduk')">Laporan Penduduk</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('staffdesa.laporanpenduduk')">Laporan Penduduk</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                <flux:breadcrumbs.item :href="route('penduduk.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('penduduk.laporanpenduduk')">Laporan Penduduk</flux:breadcrumbs.item>
            @endif

        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                {{-- Tombol Create Document Type --}}
                <flux:modal.trigger name="add_laporan-penduduk">
                        <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                            <flux:icon.document-plus variant="outline" class="size-5" />
                            Upload Laporan Penduduk
                        </flux:button>
                </flux:modal.trigger>

                <livewire:laporan-penduduk.create />
            @endif

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
                        {{-- <th scope="col" class="px-6 py-3">Name Penduduk</th> --}}
                        <th scope="col" class="px-6 py-3">Tanggal Laporan</th>
                        <th scope="col" class="px-6 py-3">Nama Laporan</th>
                        <th scope="col" class="px-6 py-3">Bukti Laporan</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($LaporanPenduduk as $laporan)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                {{-- <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $subreq->penduduk?->nama }}
                                </td> --}}
                                {{-- Tanggal Laporan --}}
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $laporan->created_at }}
                                </td>
                                {{-- Nama Laporan --}}
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $laporan->nama_laporan }}
                                </td>
                                {{-- Bukti Laporan --}}
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    @php
                                        $filePath = $laporan->bukti_laporan;
                                        $fileName = $filePath ? basename($filePath) : 'Tidak ada file';
                                    @endphp

                                    @if ($filePath)
                                        <a href="{{ asset($filePath) }}"
                                        
                                        class="inline-flex items-center px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md text-sm font-medium transition duration-200">
                                            <flux:icon.folder-arrow-down class="w-4 h-4 mr-2" />
                                            Periksa Berkas
                                        </a>
                                        <span class="text-xs text-gray-500">({{ strtoupper(pathinfo($fileName, PATHINFO_EXTENSION)) }})</span>
                                    @else
                                        <span class="text-red-500">Tidak ada template</span>
                                    @endif
                                </td>
                                <td class="px-6 py-2">

                                    <!-- Tombol Hapus (nanti bisa kita tambahkan setelah selesai bagian edit) -->
                                    <flux:button variant="danger" wire:click="confirmDelete({{ $laporan->id_laporan }})" size="sm" class="text-xs ml-1">
                                        <flux:icon.x-circle class="size-5 mr-1" />
                                    </flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="4">Data Laporan Penduduk Belum Tersedia, Silahkan tambahkan terlebih dahulu...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <livewire:document_type.edit /> --}}

                <!-- Modal Delete -->
                @if ($deleting && $deleteId)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Hapus Laporan Penduduk?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus Laporan Penduduk berikut?
                                <strong>Tindakan ini tidak bisa dibatalkan.</strong>
                            </p>

                            <div class="font-medium text-red-600 dark:text-red-400 mb-4">
                                {{ $deleteName }}
                            </div>

                            <!-- Loading State (Opsional) -->
                            @if ($this->isLoading)
                                {{-- <flux:spinner class="w-5 h-5 text-blue-500" /> --}}
                                <flux:icon.loading />
                                <span class="ml-2 text-gray-600 dark:text-gray-300">Menghapus dokumen...</span>
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