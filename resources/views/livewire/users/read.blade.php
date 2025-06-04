<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Pengguna Apps') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data Pengguna Apps dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('adminapps.dashboard')">Dasbor</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('adminapps.kelola_users.read')">Pengguna Apps</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>
            {{-- Tombol Create Document Type --}}
            <flux:modal.trigger name="add_users">
                    <flux:button class=" bg-green-700! hover:bg-green-600! transition! text-white!" size="sm">
                        <flux:icon.document-plus variant="outline" class="size-5" />
                        Buat Pengguna
                    </flux:button>
            </flux:modal.trigger>

            <livewire:users.create />

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
                        <th scope="col" class="px-6 py-3">Nama Pengguna</th>
                        <th scope="col" class="px-6 py-3">Alamat Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        {{-- <th scope="col" class="px-6 py-3">Password</th> --}}
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $usersData)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $usersData->name }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $usersData->email }}
                                </td>
                                <td>
                                    {{ $usersData->role }}
                                </td>
                                <td class="px-6 py-2">
                                    <!-- Tombol Edit -->
                                    <flux:button variant="primary" wire:click="edit({{ $usersData->id }})" size="sm" class="text-xs">
                                        <flux:icon.pencil-square class="size-5 mr-1" />
                                    </flux:button>

                                    <!-- Tombol Hapus (hanya muncul jika BUKAN role 'AdminApps' atau bukan user sendiri -->
                                    {{-- @php dd($usersData->role?->value) @endphp --}}
                                    @if ($usersData->role?->value !== "adminapps")
                                        <flux:button variant="danger" wire:click="confirmDelete({{ $usersData->id }})" size="sm" class="text-xs ml-1">
                                            <flux:icon.x-circle class="size-5 mr-1" />
                                        </flux:button>
                                    @else
                                        {{-- <flux:badge color="gray" class="ml-1">Tidak bisa dihapus</flux:badge> --}}
                                    @endif
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

                            <h2 class="text-lg font-semibold mb-4">Edit Pengguna</h2>

                            <!-- Input Name -->
                            <flux:input label="Name" wire:model="name" />

                            <!-- Input Submission Requirements -->
                            <flux:input
                                label="Alamat Email"
                                wire:model="email"
                                placeholder='Example@desanexaapps.com'
                            />
                            <flux:error field="email" />

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

                            <h2 class="text-lg font-semibold mb-4">Hapus Pengguna?</h2>

                            <p class="mb-4 text-gray-700 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus pengguna berikut?
                                <strong>Tindakan ini tidak bisa dibatalkan.</strong>
                            </p>

                            <div class="font-medium text-red-600 dark:text-red-400 mb-4">
                                {{ $deleteName }}
                            </div>

                            <!-- Loading State (Opsional) -->
                            @if ($this->isLoading)
                                {{-- <flux:spinner class="w-5 h-5 text-blue-500" /> --}}
                                <flux:icon.loading />
                                <span class="ml-2 text-gray-600 dark:text-gray-300">Menghapus pengguna...</span>
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
