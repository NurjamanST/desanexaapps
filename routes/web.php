<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashboardAdminapps;
use App\Http\Controllers\Desa\DashboardController as DashboardDesa;
use App\Http\Controllers\StaffDesa\DashboardController as DashboardStaffDesa;
use App\Http\Controllers\Penduduk\DashboardController as DashboardPenduduk;
use App\Http\Controllers\Presensi\InvalideController;
// Document Type
use App\Livewire\DocumentType\Read;
// Users
use App\Livewire\Users\Read as UsersRead;

// Pengajuan Dokumen
use App\Livewire\PengajuanDokumen\Read as PengajuanDokumenRead;

// Desa
use App\Livewire\Desa\Read as DesaRead;

// Staff Desa
use App\Livewire\StaffDesa\Read as StaffDesaRead;

// Rukun Warga
use App\Livewire\RukunWarga\Read as RukunWargaRead;

// Penduduk
use App\Livewire\Penduduk\Read as PendudukRead;

// Upload Persyaratan
use App\Livewire\SubmissionRequirement\Read as SubReqRead;

// Laporan Penduduk
use App\Livewire\LaporanPenduduk\Read as LaporanPenduduk;
// Invalide
use App\Livewire\Presensi\Invalide;
use App\Livewire\Presensi\InvalideCreate;
use App\Livewire\Sdm\Read as SdmRead;
use App\Livewire\Sdm\Update;
use App\Livewire\Sdm\View;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Apps Routes
Route::middleware(['auth', 'verified', 'adminapps'])
    ->prefix('adminapps')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardAdminapps::class, 'index'])
            ->name('adminapps.dashboard');

        // Kelola Users
        Route::get('/kelola_users/read', UsersRead::class)
            ->name('adminapps.kelola_users.read');

        // Kelola Desa
        Route::get('/kelola_desa/read', DesaRead::class)
            ->name('adminapps.kelola_desa.read');
        // Kelola Staff Desa
        Route::get('/kelola_staffdesa/read', StaffDesaRead::class)
            ->name('adminapps.kelola_staffdesa.read');
        // Kelola Rukun Warga
        Route::get('/kelola_rw/read', RukunWargaRead::class)
            ->name('adminapps.kelola_rw.read');
        // Kelola Penduduk
        Route::get('/kelola_penduduk/read', PendudukRead::class)
            ->name('adminapps.kelola_penduduk.read');
        // Jenis Dokumen
        Route::get('/document_type/read', Read::class)
            ->name('adminapps.document_type.read');
        // Laporan
        Route::view('/laporan/read', 'adminapps.laporan.read')
            ->name('adminapps.laporan.read');
    });

// Kades Routes
Route::middleware(['auth', 'verified', 'kepdesa'])
    ->prefix('kepdesa')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardStaffDesa::class, 'index'])
            ->name('kepdesa.dashboard');
        // Pengajuan
        Route::get('/pengajuandokumen/read', PengajuanDokumenRead::class)
            ->name('kepdesa.pengajuandokumen.read');
        // Laporan Penduduk
        Route::get('/laporanpenduduk', LaporanPenduduk::class)
            ->name('kepdesa.laporanpenduduk');
    });

// Staff Desa Routes
Route::middleware(['auth', 'verified', 'staffdesa'])
    ->prefix('staffdesa')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardStaffDesa::class, 'index'])
            ->name('staffdesa.dashboard');
        // Pengajuan
        Route::get('/pengajuandokumen/read', PengajuanDokumenRead::class)
            ->name('staffdesa.pengajuandokumen.read');
        // Laporan Penduduk
        Route::get('/laporanpenduduk', LaporanPenduduk::class)
            ->name('staffdesa.laporanpenduduk');

        // invalide
        Route::get('/invalide', Invalide::class)->name('staffdesa.invalide');
        Route::get('/invalide/create/{id}', InvalideCreate::class)->name('staffdesa.invalide.create');

        // SDM
        Route::get('/sdm', SdmRead::class)->name('staffdesa.sdm.read');
        Route::get('/sdm/update/{id}', Update::class)->name('staffdesa.sdm.update');
        Route::get('/sdm/view/{id}', View::class)->name('staffdesa.sdm.view');

    });

// Penduduk Routes
Route::middleware(['auth', 'verified', 'penduduk'])
    ->prefix('penduduk')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardPenduduk::class, 'index'])
            ->name('penduduk.dashboard');
        // Pengajuan Dokumen
        Route::get('/pengajuandokumen/read', PengajuanDokumenRead::class)
            ->name('penduduk.pengajuandokumen.read');
        // Upload Persyaratan
            Route::get('/uploadpersyaratan', SubReqRead::class)
        ->name('penduduk.uploadpersyaratan');
        // Laporan Penduduk
        Route::get('/laporanpenduduk', LaporanPenduduk::class)
            ->name('penduduk.laporanpenduduk');
    });



// Kelola Users Routes
Route::middleware(['auth', 'adminapps'])->group(function () {
    Route::redirect('kelolausers', 'settings/profile');
});
// Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
