<x-layouts.app :title="__('Dasbor Kepala Desa')">
    {{-- Header --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Dasbor Kepala Desa</flux:heading>
        <flux:subheading size="lg" class="mb-6">Selamat datang, {{ auth()->user()->name }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('kades.dashboard') }}">Dasbor</flux:breadcrumbs.item>
        <flux:breadcrumbs.item is-current>Kepala Desa</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- Session Success Alert --}}
    @session('success')
        <flux:callout icon="check-circle" variant="success" inline x-data="{ visible: true }" x-show="visible">
            <flux:callout.heading class="flex gap-2 items-start">
                <b>Masuk :</b>
                <flux:text class="text-green-600">{{ session('success') }}</flux:text>
            </flux:callout.heading>
            <x-slot name="controls">
                <flux:button icon="x-mark" variant="ghost" class="text-green-800" x-on:click="visible = false" />
            </x-slot>
        </flux:callout>
    @endsession

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <!-- Total Penduduk -->
        <div class="bg-blue-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
            <h2 class="text-lg font-bold">Total Penduduk</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($totalPenduduk ?? 0) }}
            </p>
        </div>

        <!-- Dokumen Pending -->
        <div class="bg-orange-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
            <h2 class="text-lg font-bold">Dokumen Pending</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($dokumenPending ?? 0) }}
            </p>
        </div>

        <!-- Dokumen Selesai -->
        <div class="bg-green-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
            <h2 class="text-lg font-bold">Dokumen Selesai</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($dokumenSelesai ?? 0) }}
            </p>
        </div>
    </div>

    {{-- Informasi Desa --}}
    @if ($ProfileDesa)
        {{-- Logo Desa --}}
        <a href="#" class="flex flex-col my-5 items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            @if ($ProfileDesa->logo_desa)
                {{-- Logo Desa --}}
                <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-48 md:rounded-none md:rounded-s-lg bg-white" src="{{ asset($ProfileDesa->logo_desa) }}" alt="">
            @else
                <span class="text-gray-500">Tidak ada logo</span>
            @endif
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $ProfileDesa->nama_lurah_desa }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Kepala Desa     : {{ $ProfileDesa->nama_kepdes }} | Sekretaris Desa : {{ $ProfileDesa->nama_sekdes }}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ $ProfileDesa->kecamatan }}
                    {{ $ProfileDesa->kota_kabupaten }}
                    {{ $ProfileDesa->provinsi }}
                </p>
            </div>
        </a>
    @else
        <flux:callout icon="information-circle" variant="info" class="mt-6">
            Anda belum memiliki data desa. Silakan tambahkan dulu.
            <x-slot name="controls">
                {{-- <flux:button wire:navigate href="{{ route('admin.desa.create') }}" variant="primary">
                    Tambahkan Data Desa
                </flux:button> --}}
            </x-slot>
        </flux:callout>
    @endif

    {{-- Riwayat Pengajuan Dokumen Terbaru --}}
    {{-- <flux:card class="mt-6">
        <flux:heading size="lg">Riwayat Pengajuan Dokumen</flux:heading>

        @php
            $latestDocs = Document::with(['user', 'documentType'])
                ->whereHas('documentType')
                ->where('status', 'pending')
                ->limit(5)
                ->get();
        @endphp

        @if ($latestDocs->isEmpty())
            <flux:text class="text-center py-4 text-gray-500">Tidak ada dokumen pengajuan terbaru</flux:text>
        @else
            <flux:table striped>
                <flux:columns>
                    <flux:th>Nama</flux:th>
                    <flux:th>Jenis Dokumen</flux:th>
                    <flux:th>Status</flux:th>
                    <flux:th>Tanggal</flux:th>
                </flux:columns>

                <flux:rows>
                    @foreach ($latestDocs as $doc)
                        <flux:tr>
                            <flux:td>{{ $doc->user?->name ?? '-' }}</flux:td>
                            <flux:td>{{ $doc->documentType?->name ?? '-' }}</flux:td>
                            <flux:td>
                                <flux:badge color="
                                    {{ match($doc->status) {
                                        'pending' => 'yellow',
                                        'processing' => 'blue',
                                        'approved' => 'green',
                                        'rejected' => 'red',
                                        default => 'gray'
                                    } }}">
                                    {{ ucfirst($doc->status) }}
                                </flux:badge>
                            </flux:td>
                            <flux:td>{{ $doc->created_at->format('d M Y H:i') }}</flux:td>
                        </flux:tr>
                    @endforeach
                </flux:rows>
            </flux:table>
        @endif
    </flux:card> --}}

    {{-- Checklist Tugas Harian --}}
    {{-- <flux:card class="mt-6">
        <flux:heading size="lg">Checklist Tugas Harian</flux:heading>
        <flux:text class="mt-2">Centang tugas yang sudah diselesaikan hari ini</flux:text>

        <flux:list class="mt-4">
            <flux:list.item>
                <flux:checkbox label="Review Pengajuan Dokumen" />
            </flux:list.item>

            <flux:list.item>
                <flux:checkbox label="Tanda Tangan Surat Masuk" />
            </flux:list.item>

            <flux:list.item>
                <flux:checkbox label="Rapat Internal Staff Desa" />
            </flux:list.item>

            <flux:list.item>
                <flux:checkbox label="Update Data Penduduk" />
            </flux:list.item>
        </flux:list>
    </flux:card> --}}
</x-layouts.app>
