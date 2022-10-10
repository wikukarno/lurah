<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardLurahController extends Controller
{
    public function index()
    {
        $user = User::count();
        $skuLurah = Letter::where('jenis_surat', 'SKU')->count();
        $skpLurah = Letter::where('jenis_surat', 'SKP')->count();
        $sktmLurah = Letter::where('jenis_surat', 'SKTM')->count();
        $skiLurah = Letter::where('jenis_surat', 'SKI')->count();
        return view('pages.lurah.dashboard', compact('user', 'skuLurah', 'skpLurah', 'sktmLurah', 'skiLurah'));
    }

    public function getLaporan(Request $request)
    {
        // $data = [
        //     'jenis_surat' => $request->jenis_surat,
        //     'bulan' => $request->bulan,
        //     'tahun' => $request->tahun,
        // ];

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
        return view('pages.lurah.laporan');
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::where('roles', ['User', 'Staff'])->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('avatar', function ($item) {
                    if ($item->avatar != null) {
                        return '<img src="' . Storage::url($item->avatar) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('alamat', function ($item) {
                    if ($item->alamat == null) {
                        return '-';
                    } else {
                        return $item->alamat;
                    }
                })
                ->rawColumns(['alamat', 'avatar'])
                ->make(true);
        }
        return view('pages.lurah.penduduk');
    }
}
