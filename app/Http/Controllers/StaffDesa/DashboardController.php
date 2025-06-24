<?php

namespace App\Http\Controllers\StaffDesa;

use App\Models\Desa;
use App\Models\Penduduk;
use App\Models\Document_type;
use App\Models\SubmissionDocument;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        // Ambil Data Statistika dari SubmissionDocument
        $ProfileDesa = Desa::where('id_users', Auth::id())->first();
        // Hitung statistik
        $totalPenduduk = User::where('role', 'penduduk')->count();
        // Hitung Demografi Penduduk | Penambahan berdsarkan Pengajuan Dokumen == Surat Kelahiran

        // Status Pengajuan Dokumen
        $ProsesPengajuan = SubmissionDocument::where('status_pengajuan', '=', 'Proses Pengajuan')->count();
        $RejectStaffDesa = SubmissionDocument::where('status_pengajuan', 'Reject Staff Desa')->count();
        $DiverifikasiStaffDesa = SubmissionDocument::where('status_pengajuan', 'Diverifikasi Staff Desa')->count();
        $AcceptKepdes = SubmissionDocument::where('status_pengajuan', 'Accept Kepdes')->count();
        $RejectKepdes = SubmissionDocument::where('status_pengajuan', 'Reject Kepdes')->count();

        // Ambil Data Jenis Dokumen
        $DocumenType = Document_type::orderBy('id')->get();

        // Kirim ke view
        return view('staffdesa.dashboard', compact(
            'ProfileDesa',
            'totalPenduduk',
            'ProsesPengajuan',
            'RejectStaffDesa',
            'DiverifikasiStaffDesa',
            'AcceptKepdes',
            'RejectKepdes',
            'DocumenType',
        ));

    }
}
