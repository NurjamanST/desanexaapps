<?php

namespace App\Http\Controllers\Admin;

use App\Models\Desa;
use App\Models\User;
use App\Models\Document_type;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik dari database
        $totalDesa = Desa::count();
        $totalPengguna = User::where('id', '!=', null)->count();
        $totalJenisDokumen = Document_type::count();

        // Kirim ke view
        return view('adminapps.dashboard', compact(
            'totalDesa',
            'totalPengguna',
            'totalJenisDokumen'
        ));

    }
}
