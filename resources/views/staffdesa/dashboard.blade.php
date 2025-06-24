<x-layouts.app :title="__('Dasbor Staff Desa')">
    {{-- Header --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Dasbor Staff Desa</flux:heading>
        <flux:subheading size="lg" class="mb-6">Selamat datang, {{ auth()->user()->name }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('staffdesa.dashboard') }}">Dasbor</flux:breadcrumbs.item>
        <flux:breadcrumbs.item is-current>Staff Desa</flux:breadcrumbs.item>
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

    @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
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
            </flux:callout>
        @endif
    @else
        
    @endif

    {{-- Demografi Penduduk --}}
    <flux:heading size="xl" class="my-6">Demografi Penduduk</flux:heading>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
        {{-- Grafik Penambahan dan Pengurangan Penduduk --}}
        <div class="bg-white text-blue-500 p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
            <h2 class="text-lg font-bold">Grafik Penduduk</h2>
            <div class="mt-4">
                Coming Soon...
                {{-- <canvas id="pendudukChart" class="w-full h-64"></canvas> --}}
            </div>
        </div>
        
        
        {{-- End Grafik --}}
    </div>
    {{-- Statistik Pengajuan Dokumen --}}
    <flux:heading size="xl" class="my-6">Statistik Pengajuan Dokumen</flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-2 mt-6">
        <!-- Diproses -->
        <div class="bg-blue-500 text-white p-6 rounded-sm shadow-lg text-center flex-1">
            <h2 class="text-sm font-bold">Proses Pengajuan</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($ProsesPengajuan ?? 0) }}
            </p>
        </div>

        <!-- Direject Staff Desa -->
        <div class="bg-red-500 text-white p-6 rounded-sm shadow-lg text-center flex-1">
            <h2 class="text-sm font-bold">Reject Staff Desa</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($RejectStaffDesa ?? 0) }}
            </p>
        </div>

        <!-- Diverifikasi Staff Desa -->
        <div class="bg-yellow-500 text-white p-6 rounded-sm shadow-lg text-center flex-1">
            <h2 class="text-sm font-bold">Diverifikasi Staff Desa</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($DiverifikasiStaffDesa ?? 0) }}
            </p>
        </div>

        <!-- DiAccept Kepala Desa -->
        <div class="bg-green-500 text-white p-6 rounded-sm shadow-lg text-center flex-1">
            <h2 class="text-sm font-bold">Accept Kepdes</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($AcceptKepdes ?? 0) }}
            </p>
        </div>

        <!-- Direject Kepala Desa -->
        <div class="bg-red-500 text-white p-6 rounded-sm shadow-lg text-center flex-1">
            <h2 class="text-sm font-bold">Reject Kepala Desa</h2>
            <p class="text-2xl font-semibold mt-2">
                {{ number_format($RejectKepdes ?? 0) }}
            </p>
        </div>
    </div>

    <flux:heading size="xl" class="my-6">Jenis Dokumen</flux:heading>
    
    <div id="accordion-color" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
        @forelse ($DocumenType as $doctype)
            <h2 id="accordion-color-heading-{{ $doctype->id }}">
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-color-body-{{ $doctype->id }}" aria-expanded="true" aria-controls="accordion-color-body-1">
                <span>{{ $doctype->name }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
                </button>
            </h2>
            <div id="accordion-color-body-{{ $doctype->id }}" class="hidden" aria-labelledby="accordion-color-heading-{{ $doctype->id }}">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                    Persyaratan Pengajuan : <br>
                    @php
                        $requirements = json_decode($doctype->submission_requirements, true);
                    @endphp

                    @if(is_array($requirements))
                        @foreach ($requirements as $req)
                        {{-- <p class="mb-2 text-gray-500 dark:text-gray-400"> --}}
                            <flux:badge class="mb-2 text-gray-500 dark:text-gray-400" color="blue">{{ ucfirst($req) }}</flux:badge>
                        {{-- </p> --}}
                        @endforeach
                    @else
                        <flux:badge color="red">Error Format</flux:badge>
                    @endif
                </div>
            </div>
        @empty
            <div class="">Data Jenis Dokumen Belum Tersedia, Silahkan tambahkan terlebih dahulu...</div>
        @endforelse
    </div>
</x-layouts.app>
