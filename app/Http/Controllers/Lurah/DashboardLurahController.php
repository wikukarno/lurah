<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardLurahController extends Controller
{
    public function index()
    {
        $dataUser = User::where('roles', 'user')->count();
        $sku = BusinessCertifications::count();
        $skp = FuneralCertifications::count();
        $sktm = IncapacityCertifications::count();
        $ski = Permits::count();

        $suratProgress = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
            ->whereHas('business', function ($query) {
                $query->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('status', 'Sedang Diproses');
            });

        $suratDitolak = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
            ->whereHas('business', function ($query) {
                $query->where('status', 'Ditolak');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('status', 'Ditolak');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('status', 'Ditolak');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('status', 'Ditolak');
            });

        $suratSelesai = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
        ->whereHas('business', function ($query) {
                $query->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('status', 'Selesai Diproses');
            });

        $getSuratDiteruskan = $suratProgress->count();
        $getSuratDitolak = $suratDitolak->count();
        $getSuratSelesai = $suratSelesai->count();

        $totalSurat = $sku + $skp + $sktm + $ski;
        return view('pages.lurah.dashboard', compact('dataUser', 'sku', 'skp', 'sktm', 'ski', 'totalSurat', 'getSuratDiteruskan', 'getSuratDitolak', 'getSuratSelesai'));
    }

    public function getLaporan(Request $request)
    {
        if (request()->ajax()) {
            // $query = Letter::with(['business', 'permits', 'incapacity', 'funeral'])->get();
            // $query = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user'])->get();
            // get all letters with their related data and user data
            $query = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user'])
                ->whereHas('business', function ($query) {
                    $query->where('status', 'Selesai Diproses');
                })
                ->whereHas('user', function ($query) {
                    $query->whereNot(function ($query) {
                        $query->where('roles', 'Lurah')->orWhere('roles', 'Staff');
                    });
                })->get();
            dd($query);
            return datatables()->of($query)
                ->addIndexColumn()
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
            $query = User::with('userDetails')->where('roles', 'user')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('avatar', function ($item) {
                    if ($item->avatar != null) {
                        return '<img src="' . Storage::url($item->avatar) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('phone', function($item){
                    if($item->userDetails->phone == null || $item->userDetails->phone == ''){
                        return '-';
                    }else{
                        return $item->userDetails->phone;
                    }
                })
                ->editColumn('address', function ($item) {
                    if ($item->userDetails->address == null || $item->userDetails->address == '') {
                        return '-';
                    } else {
                        return $item->userDetails->address;
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
