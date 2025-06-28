<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Data Card Staff') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data Card Staff dari sini:') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('kepdesa.laporanpenduduk')">Data Card Staff </flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('staffdesa.invalide')">Data Card Staff
                </flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                <flux:breadcrumbs.item :href="route('penduduk.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('penduduk.laporanpenduduk')">Data Card Staff
                </flux:breadcrumbs.item>
            @endif

        </flux:breadcrumbs>
        {{-- End breadcrumbs --}}

        {{-- Content --}}
        <div>

            <div class="overflow-x-auto my-5">
                @if (session()->has('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md dark:bg-green-900 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('warning'))
                    <div
                        class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-md dark:bg-yellow-900 dark:text-yellow-200">
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
                            <th scope="col" class="px-6 py-3">UID</th>
                            <th scope="col" class="px-6 py-3">No Identitas</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Instansi</th>
                            <th scope="col" class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data1 as $item)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $item->uid ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $item->no_identitas ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $item->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $item->instansi ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300 text-center">
                                    <button
                                        onclick="window.location.href='{{ route('staffdesa.sdm.view', $item->id) }}'"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                    </button>

                                    <button
                                        onclick="window.location.href='{{ route('staffdesa.sdm.update', $item->id) }}'"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                        </svg>
                                    </button>

                                    {{-- <a href="" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xs px-3 py-2 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a> --}}

                                    <button
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        onclick="deleteData(this)" data-id="{{ $item->id }}"><flux:icon.x-circle
                                            class="size-6 mr-1" /></button>
                                </td>
                            </tr>
                        @empty
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="4">Data Card Staff Belum Tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <livewire:document_type.edit /> --}}

            </div>
        </div>
    </div>
</section>

<script>
    function deleteData(el) {
        const id = el.getAttribute('data-id');
        if (confirm("Yakin mau hapus data ini?")) {
            fetch(`http://client_rfid.test/api/sdm/delete/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // 'Authorization': 'Bearer TOKEN_JIKA_PAKAI_AUTH'
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Gagal menghapus data");
                    }
                    return response.json();
                })
                .then(data => {
                    alert("Data berhasil dihapus!");
                    // reload atau update tampilan
                    location.reload(); // atau update list via JS
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan saat menghapus data");
                });
        }
    }
</script>
