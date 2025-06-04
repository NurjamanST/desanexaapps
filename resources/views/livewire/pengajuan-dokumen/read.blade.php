<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Pengajuan Dokumen') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data jenis dokumen dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('kepdesa.pengajuandokumen.read')">Pengajuan Dokumen</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('staffdesa.pengajuandokumen.read')">Pengajuan Dokumen</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                <flux:breadcrumbs.item :href="route('penduduk.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('penduduk.pengajuandokumen.read')">Pengajuan Dokumen</flux:breadcrumbs.item>
            @endif

        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                {{-- Tombol Create Document Type --}}
                <flux:modal.trigger name="add_subdoc">
                    <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                        <flux:icon.document-plus variant="outline" class="size-5" />
                        Buat Pengajuan Dokumen
                    </flux:button>
                </flux:modal.trigger>
                <livewire:pengajuan-dokumen.create />
            @endif

            <div class="overflow-x-auto my-5">
                {{-- Alert  --}}
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
                {{-- End Alert  --}}

                {{-- Card Pengajuan --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    @forelse ($SubmissionDocument as $subdoc)
                        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-4 dark:bg-gray-800 dark:border-gray-700">
                            {{-- Nama Dokumen --}}
                            <span class="mb-4 text-md font-medium text-gray-500 dark:text-gray-400">{{ $subdoc->doctype?->name }}</span><br>
                            {{-- Tanggal Pengajuan --}}
                            <span class="mb-4 text-sm font-medium text-gray-500 dark:text-gray-400">{{ $subdoc->created_at }}</span>
                            {{-- Nama Penduduk --}}
                            <span class="ms-1 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $subdoc->penduduk?->nama }}</span><br>
                            {{-- Status Pengajuan --}}
                            <ul role="list" class="space-y-2 my-2">
                                <li class="flex items-center">
                                    @if ($subdoc->status_pengajuan === "Proses Pengajuan")
                                        <div class="flex items-center p-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                            <flux:icon.loading />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium">{{ "Proses Pengajuan" }}</span></div>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Reject Staff Desa")
                                        <div class="flex items-center p-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                            <flux:icon.x-circle />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium">{{ "Reject Staff Desa" }}</span></div>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Diverifikasi Staff Desa")
                                        <div class="flex items-center p-2 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                            <flux:icon.viewfinder-circle />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium">{{ "Diverifikasi Staff Desa" }}</span></div>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Accept Kepdes")
                                        <div class="flex items-center p-2 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                            <flux:icon.document-check />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium">{{ "Accept Kepala Desa" }}</span></div>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Reject Kepdes")
                                        <div class="flex items-center p-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                            <flux:icon.x-circle />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium">{{ "Reject Kepala Desa" }}</span></div>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                            {{-- Status Unduh --}}
                            @php
                                $filePath = $subdoc->file_dokumen;
                                $fileName = $filePath ? basename($filePath) : 'Tidak ada file';
                            @endphp
                            {{-- Cek ketersediaan file --}}
                            @if ($filePath)
                                {{-- Cek siapa yang akses --}}
                                {{-- Jika Penduduk --}}
                                @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                                    @if ($subdoc->status_pengajuan === "Accept Kepdes" && $subdoc->status_unduh == 1)
                                        {{-- Jika status unduh 1 --}}
                                        <div class="my-3">
                                            <a href="{{ asset($filePath) }}" class="inline-flex items-center px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md text-sm font-medium transition duration-200">
                                                <flux:icon.folder-arrow-down class="w-4 h-4 mr-2" />
                                                Unduh Dokumen
                                            </a>
                                            <span class="text-xs text-gray-500">({{ strtoupper(pathinfo($fileName, PATHINFO_EXTENSION)) }})</span>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Accept Kepdes" && $subdoc->status_unduh == 0)
                                        {{-- Jika status unduh 0 --}}
                                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                                            <flux:icon.information-circle class="w-4 h-4 mr-2"/>&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium text-xs">Silakan ambil dokumen ke Kantor Desa . . .</span></div>
                                        </div>
                                    @else
                                        {{-- Status Pengajuan selain Accept Kepdes --}}
                                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800" role="alert">
                                            <flux:icon.information-circle class="w-4 h-4 mr-2"/>&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium text-xs">Dokumen menunggu ACC Kepala Desa</span></div>
                                        </div>
                                    @endif
                                {{-- Jika selain penduduk --}}
                                @elseif (auth()->user()->role === App\Enums\UserRole::Kepdesa || auth()->user()->role === App\Enums\UserRole::Staffdesa)
                                    @if ($subdoc->status_pengajuan === "Accept Kepdes" && $subdoc->status_unduh == 1)
                                        {{-- Jika status unduh 1 --}}
                                        <div class="my-3">
                                            <a href="{{ asset($filePath) }}" class="inline-flex items-center px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md text-sm font-medium transition duration-200">
                                                <flux:icon.folder-arrow-down class="w-4 h-4 mr-2" />
                                                Unduh Dokumen
                                            </a>
                                            <span class="text-xs text-gray-500">({{ strtoupper(pathinfo($fileName, PATHINFO_EXTENSION)) }})</span>
                                        </div>
                                    @elseif ($subdoc->status_pengajuan === "Accept Kepdes" && $subdoc->status_unduh == 0)
                                        {{-- Jika status unduh 0 --}}
                                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                                            <flux:icon.information-circle class="w-4 h-4 mr-2"/>&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium text-xs">Silakan ambil dokumen ke Kantor Desa . . .</span></div>
                                        </div>
                                    @else
                                        {{-- Status Pengajuan selain Accept Kepdes --}}
                                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800" role="alert">
                                            <flux:icon.information-circle class="w-4 h-4 mr-2"/>&nbsp;&nbsp;&nbsp;
                                            <div><span class="font-medium text-xs">Dokumen menunggu ACC Kepala Desa</span></div>
                                        </div>
                                    @endif
                                @endif
                            @else
                            {{-- Jika file dokumen belum tersedia --}}
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                                <flux:icon.information-circle class="w-4 h-4 mr-2"/>&nbsp;&nbsp;&nbsp;
                                <div><span class="font-medium text-xs">File Dokumen Belum Tersedia . . .</span></div>
                                {{-- Aksi Upload File Pengajuan --}}
                            </div>
                            @endif
                            {{-- Kumpulan aksi --}}
                            <div class="grid items-center text-center justify-center">
                                <flux:button.group>
                                    {{-- Lihat Persyaratan --}}
                                    <flux:tooltip content="Lihat Persyaratan">
                                        <flux:button icon="ellipsis-horizontal-circle" icon:variant="outline" wire:click="show({{ $subdoc->id_subdoc }})" size="sm" class="text-xs"/>
                                    </flux:tooltip>
                                    {{-- Role Penduduk --}}
                                    @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                                        @if ($subdoc->status_pengajuan == "Proses Pengajuan")
                                            {{-- Hapus Pengajuan --}}
                                            <flux:tooltip content="Hapus Pengajuan">
                                                <flux:button icon="backspace" icon:variant="outline" wire:click="confirmDelete({{ $subdoc->id_subdoc }})" size="sm" class="text-xs"/>
                                            </flux:tooltip>
                                        @endif
                                    @endif
                                </flux:button.group>
                            </div>
                            {{-- Catatan --}}
                            <small>Catatan : {{ $subdoc->catatan }}</small>
                        </div>
                    @empty
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">Belum ada data Pengajuan,</span> Silakan lakukan pengajuan dokumen . . .
                        </div>
                    @endforelse
                </div>
                {{-- End Card Pengajuan --}}

                <!-- Modal Showing Persyaratan -->
                @if ($Showing)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-7xl shadow-lg gap-5 mx-4 animate-fadeIn">
                            <h2 class="text-xl font-bold mb-4">Detail Persyaratan</h2>
                            {{-- Tampilkan Tabel data persyaratan--}}
                            <div class="overflow-x-auto">
                                {{-- Tabel Persyaratan yang perlu di upload --}}
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Dokumen</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persyaratan yang perlu dilengkapi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($data_doctype as $doctype)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $doctype->name }}</td>
                                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                                    <div class="flex flex-wrap gap-2">
                                                        @php
                                                            $requirements = json_decode($doctype->submission_requirements, true);
                                                        @endphp

                                                        @if(is_array($requirements))
                                                            @foreach ($requirements as $req)
                                                                <flux:badge color="blue">{{ ucfirst($req) }}</flux:badge>
                                                            @endforeach
                                                        @else
                                                            <flux:badge color="red">Error Format</flux:badge>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Tabel Persyaratan yang diupload Penduduk --}}
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penduduk</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persyaratan</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Persyaratan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->penduduk?->nama }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($item->file_persyaratan)
                                                        <a href="{{ asset('storage/' . $item->file_persyaratan) }}" target="_blank" class="text-blue-500 underline">
                                                            Lihat File
                                                        </a>
                                                    @else
                                                        <span class="text-gray-500">Tidak ada file tersedia</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- Tombol Tutup Modal --}}
                            <div class="flex justify-end mt-6">
                                <flux:button wire:click="closeModal" variant="filled" size="sm">Tutup</flux:button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Modal Konfirmasi Hapus --}}
                @if ($deleting && $deleteId)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Hapus Hapus Pengajuan?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus Pengajuan berikut? <br>
                                <strong>Tindakan ini tidak bisa dibatalkan.</strong>
                            </p>

                            <div class="font-medium text-red-600 dark:text-red-400 mb-4">
                                {{ $deleteName }}
                            </div>

                            @if ($this->isLoading)
                                <flux:icon.loading />
                                <span class="ml-2 text-gray-600 dark:text-gray-300">Menghapus Pengajuan...</span>
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
