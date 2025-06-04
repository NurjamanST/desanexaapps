<?php

namespace App\Http\Controllers\Desa;

use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Ambil data desa milik user login
        $ProfileDesa = Desa::where('id_users', Auth::id())->first();
        // Hitung statistik
        $totalPenduduk = User::where('role', 'penduduk')->count();
        // $dokumenPending = Document::where('status', 'pending')->count();
        // $dokumenSelesai = Document::where('status', 'approved')->count();
        // Data Dummy
        // $totalPenduduk = 100; // Ganti dengan logika yang sesuai
        $dokumenPending = 5; // Ganti dengan logika yang sesuai
        $dokumenSelesai = 20; // Ganti dengan logika yang sesuai

        // Kirim ke view
        return view('kades.dashboard', compact(
            'ProfileDesa',
            'totalPenduduk',
            'dokumenPending',
            'dokumenSelesai'
        ));

    }
}
