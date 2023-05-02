<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\SKI;
use App\Models\SKP;
use App\Models\SKTM;
use App\Models\SKU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        // dapatkan semua data surat yang dimiliki user yang sedang login
        $getBusiness = SKU::where('id_user', Auth::user()->id)->count();
        $getFunerals = SKP::where('id_user', Auth::user()->id)->count();
        $getIncapacity = SKTM::where('id_user', Auth::user()->id)->count();
        $getPermits = SKI::where('id_user', Auth::user()->id)->count();

        // dapatkan semua data surat yang dimiliki user yang sedang login berdasarkan status
        $getSuratDitolak = Laporan::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();
        $getSuratDiproses = Laporan::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getSuratSelesai = Laporan::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();

        // hitung total surat yang dimiliki user yang sedang login
        $totalSurat = $getBusiness + $getFunerals + $getIncapacity + $getPermits;

        return view('pages.user.dashboard', compact('totalSurat', 'getSuratDitolak', 'getSuratDiproses', 'getSuratSelesai'));
    }
}
