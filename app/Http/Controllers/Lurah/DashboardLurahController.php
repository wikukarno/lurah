<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardLurahController extends Controller
{
    public function index()
    {
        $user = User::whereIn('roles', [
            'user',
            'staff',
        ])->count();
        $skuLurah = Letter::where('jenis_surat', 'SKU')->where('status', 'Sedang Diproses')->count();
        $skpLurah = Letter::where('jenis_surat', 'SKP')->where('status', 'Sedang Diproses')->count();
        $sktmLurah = Letter::where('jenis_surat', 'SKTM')->where('status', 'Sedang Diproses')->count();
        $skiLurah = Letter::where('jenis_surat', 'SKI')->where('status', 'Sedang Diproses')->count();
        $skDisetujui = Letter::where('status', 'Selesai Diproses')->count();
        return view('pages.lurah.dashboard', compact('user', 'skuLurah', 'skpLurah', 'sktmLurah', 'skiLurah', 'skDisetujui'));
    }

    public function getLaporan(Request $request)
    {
        if (request()->ajax()) {
            $query = Letter::with(['user'])->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('jenis_surat', function ($item) {
                    if (
                        $item->jenis_surat == 'SKU'
                    ) {
                        return 'Surat Keterangan Usaha';
                    } elseif ($item->jenis_surat == 'SKTM') {
                        return 'Surat Keterangan Tidak Mampu';
                    } elseif ($item->jenis_surat == 'SKP') {
                        return 'Surat Keterangan Pemakaman';
                    } elseif ($item->jenis_surat == 'SKI') {
                        return 'Surat Izin';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->format('d F Y');
                })
                ->rawColumns(['created_at', 'updated_at'])
                ->make(true);
        }

        $year = Letter::selectRaw('YEAR(created_at) year')->groupBy('year')->get();
        $month = Letter::selectRaw('MONTH(created_at) month')->groupBy('month')->get();
        return view('pages.lurah.laporan', [
            'years' => $year,
            'months' => $month,
        ]);
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::query()->whereNot('roles', 'Lurah')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('avatar', function ($item) {
                    if ($item->avatar != null) {
                        return '<img src="' . Storage::url($item->avatar) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('name', function ($item) {
                    if ($item->name == null || $item->name == '') {
                        return '-';
                    } else {
                        return $item->name;
                    }
                })
                ->editColumn('address', function ($item) {
                    if ($item->address == null || $item->address == '') {
                        return '-';
                    } else {
                        return $item->address;
                    }
                })
                ->rawColumns(['address', 'avatar'])
                ->make(true);
        }
        return view('pages.lurah.penduduk');
    }

    public function filterLaporanBulanan(Request $request)
    {

        if (request()->ajax()) {
            // get bulan
            $months = Letter::whereMonth('created_at', $request->month)->get();

            return datatables()->of($months)
                ->addIndexColumn()
                ->editColumn('jenis_surat', function ($item) {
                    if (
                        $item['jenis_surat'] == 'SKU'
                    ) {
                        return 'Surat Keterangan Usaha';
                    } elseif ($item['jenis_surat'] == 'SKTM') {
                        return 'Surat Keterangan Tidak Mampu';
                    } elseif ($item['jenis_surat'] == 'SKP') {
                        return 'Surat Keterangan Pemakaman';
                    } elseif ($item['jenis_surat'] == 'SKI') {
                        return 'Surat Izin';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at', 'jenis_surat'])
                ->make(true);
        }
    }

    public function filterLaporanTahunan(Request $request)
    {
        if (request()->ajax()) {

            $years = Letter::whereYear('created_at', $request->year)->get();

            return datatables()->of($years)
                ->addIndexColumn()
                ->editColumn('jenis_surat', function ($item) {
                    if (
                        $item['jenis_surat'] == 'SKU'
                    ) {
                        return 'Surat Keterangan Usaha';
                    } elseif ($item['jenis_surat'] == 'SKTM') {
                        return 'Surat Keterangan Tidak Mampu';
                    } elseif ($item['jenis_surat'] == 'SKP') {
                        return 'Surat Keterangan Pemakaman';
                    } elseif ($item['jenis_surat'] == 'SKI') {
                        return 'Surat Izin';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at', 'jenis_surat'])
                ->make(true);
        }
    }

    public function filterLaporanbulananTahunan(Request $request)
    {
        if (request()->ajax()) {

            $getMonthYear = Letter::whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->get();

            return datatables()->of($getMonthYear)
                ->addIndexColumn()
                ->editColumn('jenis_surat', function ($item) {
                    if (
                        $item['jenis_surat'] == 'SKU'
                    ) {
                        return 'Surat Keterangan Usaha';
                    } elseif ($item['jenis_surat'] == 'SKTM') {
                        return 'Surat Keterangan Tidak Mampu';
                    } elseif ($item['jenis_surat'] == 'SKP') {
                        return 'Surat Keterangan Pemakaman';
                    } elseif ($item['jenis_surat'] == 'SKI') {
                        return 'Surat Izin';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->rawColumns(['created_at', 'updated_at', 'jenis_surat'])
                ->make(true);
        }
    }
}
