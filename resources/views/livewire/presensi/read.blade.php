<section>
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Data Presensi') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data Presensi dari sini:') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- breadcrumbs --}}
        <flux:breadcrumbs>
            @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                <flux:breadcrumbs.item :href="route('kepdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('kepdesa.laporanpenduduk')">Data Presensi</flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                <flux:breadcrumbs.item :href="route('staffdesa.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('staffdesa.presensi.read')">Data Presensi
                </flux:breadcrumbs.item>
            @endif
            @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                <flux:breadcrumbs.item :href="route('penduduk.dashboard')">Dasbor</flux:breadcrumbs.item>
                <flux:breadcrumbs.item :href="route('penduduk.laporanpenduduk')">Data Presensi
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
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Jam Masuk</th>
                            <th scope="col" class="px-6 py-3">Jam Keluar</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data1 as $index => $presensi)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->sdm->uid }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->sdm->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->jam_masuk ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->jam_keluar ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->setatus ?? '-' }}
                                </td>
                                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                    {{ $presensi->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="text-center py-5" colspan="4">Data Presensi Belum Tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <livewire:document_type.edit /> --}}

            </div>
        </div>
    </div>
</section>

