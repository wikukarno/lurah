<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\Category;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\KategoriSurat;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\SKI;
use App\Models\SKP;
use App\Models\SKTM;
use App\Models\SKU;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardLurahController extends Controller
{
    public function index()
    {
        $dataUser = User::whereNot('roles', 'lurah')->Where('status_account', 'verifikasi')->count();
        $sku = SKU::count();
        $skp = SKP::count();
        $sktm = SKTM::count();
        $ski = SKI::count();

        $skuMasuk = SKU::where('posisi', 'lurah')->count();
        $skpMasuk = SKP::where('posisi', 'lurah')->count();
        $sktmMasuk = SKTM::where('posisi', 'lurah')->count();
        $skiMasuk = SKI::where('posisi', 'lurah')->count();

        $skuProses = SKU::where('status', 'Sedang Diproses')->count();
        $skpProses = SKP::where('status', 'Sedang Diproses')->count();
        $sktmProses = SKTM::where('status', 'Sedang Diproses')->count();
        $skiProses = SKI::where('status', 'Sedang Diproses')->count();

        $skuSelesai = SKU::where('status', 'Selesai Diproses')->count();
        $skpSelesai = SKP::where('status', 'Selesai Diproses')->count();
        $sktmSelesai = SKTM::where('status', 'Selesai Diproses')->count();
        $skiSelesai = SKI::where('status', 'Selesai Diproses')->count();

        $skuDitolak = SKU::where('status', 'Ditolak')->count();
        $skpDitolak = SKP::where('status', 'Ditolak')->count();
        $sktmDitolak = SKTM::where('status', 'Ditolak')->count();
        $skiDitolak = SKI::where('status', 'Ditolak')->count();


        $totalSurat = $sku + $skp + $sktm + $ski;

        $totalSuratProses = Laporan::where('status', 'Sedang Diproses')->count();
        $totalSuratSelesai = Laporan::where('status', 'Selesai Diproses')->count();
        $totalSuratDitolak = Laporan::where('status', 'Ditolak')->count();


        return view('pages.lurah.dashboard', compact('dataUser', 'totalSurat', 'sku', 'skp', 'sktm', 'ski', 'skuMasuk', 'skpMasuk', 'sktmMasuk', 'skiMasuk', 'skuProses', 'skpProses', 'sktmProses', 'skiProses', 'skuSelesai', 'skpSelesai', 'sktmSelesai', 'skiSelesai', 'skuDitolak', 'skpDitolak', 'sktmDitolak', 'skiDitolak', 'totalSuratProses', 'totalSuratSelesai', 'totalSuratDitolak'));
    }

    public function getLaporan(Request $request)
    {
        if (request()->ajax()) {
            $query = Laporan::with('user', 'category')->where('status', 'Selesai Diproses')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                // ->editColumn('nama', function ($item) {
                //     $category = KategoriSurat::where('id_kategori_surat', $item->id_kategori_surat)->first();
                //     if ($item->id_kategori_surat == $category->id_kategori_surat) {
                //         return $item->nama != null ? $item->nama : $item->user->name;
                //     }
                // })
                ->editColumn('id_kategori_surat', function ($item) {
                    return $item->category->nama;
                })
                ->editColumn('tahun', function ($item) {
                    // foreach ($item->business as $business) {
                    //     return $business->created_at->isoFormat('Y');
                    // }
                    // foreach ($item->funeral as $funeral) {
                    //     return $funeral->created_at->isoFormat('Y');
                    // }
                    // foreach ($item->incapacity as $incapacity) {
                    //     return $incapacity->created_at->isoFormat('Y');
                    // }
                    // foreach ($item->permits as $permits) {
                    //     return $permits->created_at->isoFormat('Y');
                    // }
                    return $item->created_at->isoFormat('Y');
                })
                ->editColumn('bulan', function ($item) {
                    // foreach ($item->business as $business) {
                    //     return $business->created_at->isoFormat('MMMM');
                    // }
                    // foreach ($item->funeral as $funeral) {
                    //     return $funeral->created_at->isoFormat('MMMM');
                    // }
                    // foreach ($item->incapacity as $incapacity) {
                    //     return $incapacity->created_at->isoFormat('MMMM');
                    // }
                    // foreach ($item->permits as $permits) {
                    //     return $permits->created_at->isoFormat('MMMM');
                    // }
                    return $item->created_at->isoFormat('MMMM');
                })
                // ->editColumn('nik', function ($item) {
                //     return $item->user->userDetails->nik;
                // })
                ->editColumn('created_at', function ($item) {
                    // foreach ($item->business as $business) {
                    //     return $business->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->funeral as $funeral) {
                    //     return $funeral->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->incapacity as $incapacity) {
                    //     return $incapacity->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->permits as $permits) {
                    //     return $permits->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    // foreach ($item->business as $business) {
                    //     return $business->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->funeral as $funeral) {
                    //     return $funeral->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->incapacity as $incapacity) {
                    //     return $incapacity->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    // foreach ($item->permits as $permits) {
                    //     return $permits->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    // }
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at', 'nik', 'nama', 'tahun', 'bulan', 'categories_id'])
                ->make(true);
        }

        // $month = Laporan::with('user.userDetails')->selectRaw('MONTH(created_at) month')->groupBy('month')->get();
        // $year = Laporan::with('user.userDetails')->selectRaw('YEAR(created_at) year')->groupBy('year')->get();

        // make sure to use the right syntax for your query builder and model relationships (if you have any) and make sure you have the right table names in your database.

        $months = Laporan::selectRaw('MONTH(created_at) month')->groupBy('month')->get();
        $years = Laporan::selectRaw('YEAR(created_at) year')->groupBy('year')->get();

        return view('pages.lurah.laporan', compact('months', 'years'));
    }


    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::whereIn('roles', ['User', 'Staff'])->where('status_account', 'verifikasi')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('pages.lurah.penduduk');
    }

    public function filterLaporanBulanan(Request $request)
    {

        if (request()->ajax()) {

            // $months = Laporan::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])->whereMonth('created_at', $request->month)->get();


            $months = Laporan::where('status', 'Selesai Diproses')->whereMonth('created_at', $request->month)->get();

            return datatables()->of($months)
                ->addIndexColumn()
                ->editColumn('nik', function ($item) {
                    return $item->user->userDetails->nik;
                })
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at'])
                ->make(true);
        }
    }

    public function filterLaporanTahunan(Request $request)
    {
        if (request()->ajax()) {

            $years = Laporan::where('status', 'Selesai Diproses')->whereYear('created_at', $request->year)->get();

            return datatables()->of($years)
                ->addIndexColumn()
                ->editColumn('nik', function ($item) {
                    return $item->user->userDetails->nik;
                })
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at'])
                ->make(true);
        }
    }

    public function filterLaporanbulananTahunan(Request $request)
    {
        if (request()->ajax()) {

            $getMonthYear = Laporan::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])->selectRaw('MONTH(created_at) month, YEAR(created_at) year')->whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->get();

            return datatables()->of($getMonthYear)
                ->addIndexColumn()
                ->editColumn('nik', function ($item) {
                    return $item->user->userDetails->nik;
                })
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at'])
                ->make(true);
        }
    }
}
