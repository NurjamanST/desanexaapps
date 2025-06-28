<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="#" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">

                    {{-- Menu Admin Apps DesaNexaApps (DNA) --}}
                    @if (auth()->user()->role === App\Enums\UserRole::Adminapps)
                        {{-- Label Menu --}}
                        <flux:navlist.item wire:navigate>{{ __('Menu Admin Apps ') }}</flux:navlist.item>
                        {{-- Dashboard Admin Apps --}}
                        <flux:navlist.item icon="rectangle-group" :href="route('adminapps.dashboard')" wire:navigate>{{ __('Dasbor') }}</flux:navlist.item>
                        {{-- Kelola Users [Kelapa Desa, Staff Desa, RW, Penduduk] --}}
                        <flux:navlist.item icon="user-circle" :href="route('adminapps.kelola_users.read')" wire:navigate>{{ __('Kelola Users') }}</flux:navlist.item>
                        {{-- Kelola Desa --}}
                        <flux:navlist.item icon="building-office-2" :href="route('adminapps.kelola_desa.read')" wire:navigate>{{ __('Kelola Desa') }}</flux:navlist.item>
                        {{-- Kelola Staff Desa --}}
                        <flux:navlist.item icon="identification" :href="route('adminapps.kelola_staffdesa.read')" wire:navigate>{{ __('Kelola Staff Desa') }}</flux:navlist.item>
                        {{-- Kelola RW --}}
                        <flux:navlist.item icon="users" :href="route('adminapps.kelola_rw.read')" wire:navigate>{{ __('Kelola Rukun Warga (RW)') }}</flux:navlist.item>
                        {{-- Kelola Penduduk --}}
                        <flux:navlist.item icon="user-group" :href="route('adminapps.kelola_penduduk.read')" wire:navigate>{{ __('Kelola Penduduk') }}</flux:navlist.item>
                        {{-- Kelola Jenis Dokumen --}}
                        <flux:navlist.item icon="document-duplicate" :href="route('adminapps.document_type.read')" wire:navigate>{{ __('Jenis Dokumen') }}</flux:navlist.item>
                        {{-- Laporan Statistika --}}
                        <flux:navlist.item icon="archive-box" :href="route('adminapps.laporan.read')" wire:navigate>{{ __('Laporan & Statistik') }}</flux:navlist.item>

                    @endif
                    {{-- Kepala Desa --}}
                    @if (auth()->user()->role === App\Enums\UserRole::Kepdesa)
                        {{-- Label Menu Kepala Desa  --}}
                        <flux:navlist.item wire:navigate>{{ __('Menu Kepala Desa') }}</flux:navlist.item>
                            {{-- Dashboard Kades --}}
                            <flux:navlist.item icon="square-3-stack-3d" :href="route('kepdesa.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                            {{-- Pengajuan Dokumen Perlu ACC--}}
                            <flux:navlist.item icon="document-arrow-down" :href="route('kepdesa.pengajuandokumen.read')" wire:navigate>{{ __('Pengajuan Dokumen') }}</flux:navlist.item>
                            {{-- Laporan Penduduk --}}
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('kepdesa.laporanpenduduk')" wire:navigate>{{ __('Laporan Penduduk') }}</flux:navlist.item>                    @endif
                    {{-- Staff Desa --}}
                    @if (auth()->user()->role === App\Enums\UserRole::Staffdesa)
                        {{-- label Menu Staff Desa--}}
                        <flux:navlist.item wire:navigate>{{ __('Menu Staff Desa') }}</flux:navlist.item>
                            {{-- Dashboard Staff Desa --}}
                            <flux:navlist.item icon="square-3-stack-3d" :href="route('staffdesa.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                            {{-- Presence presensi --}}
                            <flux:navlist.item icon="check" href="" rel="noopener noreferrer">{{ __('Data Presensi') }}</flux:navlist.item>
                            {{-- data smd --}}
                            <flux:navlist.item icon="users" href="{{ route('staffdesa.sdm.read') }}" rel="noopener noreferrer">{{ __('Data Card Staff') }}</flux:navlist.item>
                            {{-- Data invalide --}}
                            <flux:navlist.item icon="arrow-left" href="{{route('staffdesa.invalide')}}" rel="noopener noreferrer">{{ __('Data Invalide') }}</flux:navlist.item>
                            {{-- Pengajuan Dokumen --}}
                            <flux:navlist.item icon="folder" :href="route('staffdesa.pengajuandokumen.read')" wire:navigate>{{ __('Pengajuan Dokumen') }}</flux:navlist.item>
                            {{-- Laporan Penduduk --}}
                            <flux:navlist.item icon="flag" :href="route('staffdesa.laporanpenduduk')" wire:navigate>{{ __('Laporan Penduduk') }}</flux:navlist.item>
                    @endif
                    {{-- Rukun Warga --}}
                    @if (auth()->user()->role === App\Enums\UserRole::Rukunwarga)
                    {{-- label Menu --}}
                        <flux:navlist.item wire:navigate>{{ __('Menu Rukun Warga') }}</flux:navlist.item>
                        <flux:navlist.item icon="list-bullet" :href="route('dashboard')" wire:navigate>{{ __('Menu List') }}</flux:navlist.item>
                    @endif
                    {{-- Menu Penduduk --}}
                    @if (auth()->user()->role === App\Enums\UserRole::Penduduk)
                        {{-- Label Menu Penduduk --}}
                        <flux:navlist.item wire:navigate>{{ __('Menu Penduduk') }}</flux:navlist.item>
                            {{-- Dashboard Penduduk --}}
                            <flux:navlist.item icon="square-3-stack-3d" :href="route('penduduk.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                            {{-- Pengajuan Dokumen --}}
                            <flux:navlist.item icon="document-arrow-down" :href="route('penduduk.pengajuandokumen.read')" wire:navigate>{{ __('Pengajuan Dokumen') }}</flux:navlist.item>
                            {{-- Upload Berkas Persyaratan --}}
                            <flux:navlist.item icon="arrow-up-on-square-stack" :href="route('penduduk.uploadpersyaratan')" wire:navigate>{{ __('Upload Berkas Persyaratan') }}</flux:navlist.item>
                            {{-- Laporan Penduduk --}}
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('penduduk.laporanpenduduk')" wire:navigate>{{ __('Laporan Penduduk') }}</flux:navlist.item>
                    @endif
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            {{-- <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist> --}}

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()" icon-trailing="chevrons-up-down"/>

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
