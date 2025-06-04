<?php

namespace App\Http\Controllers\Penduduk;

use App\Enums\UserRole;
use App\Models\Penduduk;
use App\Models\Document_type;
use App\Models\SubmissionDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(){
        if (auth()->user()->role === UserRole::Penduduk) {
            $this->id_login = auth()->user()->id;
            $this->penduduk = Penduduk::where('id_users', $this->id_login)->get('id_penduduk');
            foreach ($this->penduduk as $value) {
                $this->id_penduduk = $value->id_penduduk;
            }
            // Ambil Data Statistika dari SubmissionDocument
            $ProsesPengajuan = SubmissionDocument::where([['status_pengajuan', '=', 'Proses Pengajuan'],['id_penduduk', '=', $this->id_penduduk],])->count();
            $RejectStaffDesa = SubmissionDocument::where('status_pengajuan', 'Reject Staff Desa')->where('id_penduduk', $this->id_penduduk)->count();
            $DiverifikasiStaffDesa = SubmissionDocument::where('status_pengajuan', 'Diverifikasi Staff Desa')->where('id_penduduk', $this->id_penduduk)->count();
            $AcceptKepdes = SubmissionDocument::where('status_pengajuan', 'Accept Kepdes')->where('id_penduduk', $this->id_penduduk)->count();
            $RejectKepdes = SubmissionDocument::where('status_pengajuan', 'Reject Kepdes')->where('id_penduduk', $this->id_penduduk)->count();
            // $this->SubmissionDocument = SubmissionDocument::where('id_penduduk', $this->id_penduduk)->get();
        }else {
            // $this->SubmissionDocument = SubmissionDocument::get();
        }

        // Ambil Data Jenis Dokumen
        $DocumenType = Document_type::orderBy('id')->get();
        // Desa::where('id_users', Auth::id())->first();

        // Kirim ke view
            return view('penduduk.dashboard', compact(
                'ProsesPengajuan',
                'RejectStaffDesa',
                'DiverifikasiStaffDesa',
                'AcceptKepdes',
                'RejectKepdes',
                'DocumenType',
            ));
    }
}
