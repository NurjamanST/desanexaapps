<x-layouts.app :title="__('Dasbor Aplikasi Admin')">
    {{-- Settings Heading --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Dasbor') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Kelola data modul dari sini:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Settings Content --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        {{-- Breadcrumbs --}}
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#">Dasbor</flux:breadcrumbs.item>
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
        <div class="flex justify-between gap-4 p-4">
            {{-- Total Desa --}}
            <div class="bg-blue-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
                <h2 class="text-lg font-bold">Total Desa</h2>
                <p class="text-2xl font-semibold mt-2">
                    {{ number_format($totalDesa) }}
                </p>
            </div>

            {{-- Total Pengguna --}}
            <div class="bg-green-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
                <h2 class="text-lg font-bold">Pengguna</h2>
                <p class="text-2xl font-semibold mt-2">
                    {{ number_format($totalPengguna) }}
                </p>
            </div>

            {{-- Jenis Dokumen --}}
            <div class="bg-yellow-500 text-white p-6 rounded-sm shadow-lg text-center flex-1 min-w-[200px]">
                <h2 class="text-lg font-bold">Jenis Dokumen</h2>
                <p class="text-2xl font-semibold mt-2">
                    {{ number_format($totalJenisDokumen ) }}
                </p>
            </div>
        </div>
        {{-- End Box Menu --}}

    </div>
</x-layouts.app>
