<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Jenis Dokumen') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data jenis dokumen dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('adminapps.dashboard')">Dasbor</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('adminapps.document_type.read')">Jenis Dokumen</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            {{-- Tombol Create Document Type --}}
            <flux:modal.trigger name="add_document_type">
                    <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                        <flux:icon.document-plus variant="outline" class="size-5" />
                        Buat Jenis Dokumen
                    </flux:button>
            </flux:modal.trigger>

            <livewire:document_type.create />

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
                        <th scope="col" class="px-6 py-3">Name Document</th>
                        <th scope="col" class="px-6 py-3">Template Layout</th>
                        <th scope="col" class="px-6 py-3">Submission Requirements</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($documen_type as $doctype)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $doctype->name }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    @php
                                        $filePath = $doctype->template_layout;
                                        $fileName = $filePath ? basename($filePath) : 'Tidak ada file';
                                    @endphp

                                    @if ($filePath)
                                        <a href="{{ asset($filePath) }}"
                                        
                                        class="inline-flex items-center px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md text-sm font-medium transition duration-200">
                                            <flux:icon.folder-arrow-down class="w-4 h-4 mr-2" />
                                            Unduh Template
                                        </a>
                                        <span class="text-xs text-gray-500">({{ strtoupper(pathinfo($fileName, PATHINFO_EXTENSION)) }})</span>
                                    @else
                                        <span class="text-red-500">Tidak ada template</span>
                                    @endif
                                </td>
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
                                <td class="px-6 py-2">
                                    <!-- Tombol Edit -->
                                    <flux:button variant="primary" wire:click="edit({{ $doctype->id }})" size="sm" class="text-xs">
                                        <flux:icon.pencil-square class="size-5 mr-1" />
                                    </flux:button>

                                    <!-- Tombol Hapus (nanti bisa kita tambahkan setelah selesai bagian edit) -->
                                    <flux:button variant="danger" wire:click="confirmDelete({{ $doctype->id }})" size="sm" class="text-xs ml-1">
                                        <flux:icon.x-circle class="size-5 mr-1" />
                                    </flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="4">Data Jenis Dokumen Belum Tersedia, Silahkan tambahkan terlebih dahulu...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <livewire:document_type.edit /> --}}

                <!-- Modal Edit -->
                @if ($editing && $editId)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Edit Jenis Dokumen</h2>

                            <!-- Input Name -->
                            <flux:input label="Name" wire:model="name" />

                            <!-- Input Submission Requirements -->
                            <flux:input
                                label="Submission Requirements"
                                wire:model="submission_requirements"
                                placeholder='["nama", "nik", "ttl"]'
                                help="Format JSON Array"
                            />
                            <flux:error field="submission_requirements" />

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

                            <h2 class="text-lg font-semibold mb-4">Hapus Jenis Dokumen?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus jenis dokumen berikut?
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
