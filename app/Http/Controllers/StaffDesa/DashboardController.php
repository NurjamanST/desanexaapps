<?php

namespace App\Http\Controllers\StaffDesa;

use App\Models\Desa;
use App\Models\Penduduk;
use App\Models\Document_type;
use App\Models\SubmissionDocument;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // $this->id_login = auth()->user()->id;
        // $this->penduduk = Penduduk::where('id_users', $this->id_login)->get('id_penduduk');
        // foreach ($this->penduduk as $value) {
        //     $this->id_penduduk = $value->id_penduduk;
        // }

        // Ambil Data Statistika dari SubmissionDocument
        $ProsesPengajuan = SubmissionDocument::where('status_pengajuan', '=', 'Proses Pengajuan')->count();
        $RejectStaffDesa = SubmissionDocument::where('status_pengajuan', 'Reject Staff Desa')->count();
        $DiverifikasiStaffDesa = SubmissionDocument::where('status_pengajuan', 'Diverifikasi Staff Desa')->count();
        $AcceptKepdes = SubmissionDocument::where('status_pengajuan', 'Accept Kepdes')->count();
        $RejectKepdes = SubmissionDocument::where('status_pengajuan', 'Reject Kepdes')->count();

        // Ambil Data Jenis Dokumen
        $DocumenType = Document_type::orderBy('id')->get();

        // Kirim ke view
        return view('staffdesa.dashboard', compact(
            'ProsesPengajuan',
            'RejectStaffDesa',
            'DiverifikasiStaffDesa',
            'AcceptKepdes',
            'RejectKepdes',
            'DocumenType',
        ));

    }
}
