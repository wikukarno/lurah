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
        $dataUser = User::whereNot('roles', 'lurah')->Where('status_account', 'verifikasi')->count();
        $sku = BusinessCertifications::where('posisi', 'lurah')->count();
        $skp = FuneralCertifications::where('posisi', 'lurah')->count();
        $sktm = IncapacityCertifications::where('posisi', 'lurah')->count();
        $ski = Permits::where('posisi', 'lurah')->count();

        // $suratProgress = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
        //     ->whereHas('business', function ($query) {
        //         $query->where('status', 'Sedang Diproses');
        //     })
        //     ->orWhereHas('funeral', function ($query) {
        //         $query->where('status', 'Sedang Diproses');
        //     })
        //     ->orWhereHas('incapacity', function ($query) {
        //         $query->where('status', 'Sedang Diproses');
        //     })
        //     ->orWhereHas('permits', function ($query) {
        //         $query->where('status', 'Sedang Diproses');
        //     });

        // $suratDitolak = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
        //     ->whereHas('business', function ($query) {
        //         $query->where('status', 'Ditolak');
        //     })
        //     ->orWhereHas('funeral', function ($query) {
        //         $query->where('status', 'Ditolak');
        //     })
        //     ->orWhereHas('incapacity', function ($query) {
        //         $query->where('status', 'Ditolak');
        //     })
        //     ->orWhereHas('permits', function ($query) {
        //         $query->where('status', 'Ditolak');
        //     });

        // $suratSelesai = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
        //     ->whereHas('business', function ($query) {
        //         $query->where('status', 'Selesai Diproses');
        //     })
        //     ->orWhereHas('funeral', function ($query) {
        //         $query->where('status', 'Selesai Diproses');
        //     })
        //     ->orWhereHas('incapacity', function ($query) {
        //         $query->where('status', 'Selesai Diproses');
        //     })
        //     ->orWhereHas('permits', function ($query) {
        //         $query->where('status', 'Selesai Diproses');
        //     });

        // $getSuratDiteruskan = $suratProgress->count();
        // $getSuratDitolak = $suratDitolak->count();
        // $getSuratSelesai = $suratSelesai->count();

        $skuProgress = BusinessCertifications::where('status', 'Sedang Diproses')->count();
        $skpProgress = FuneralCertifications::where('status', 'Sedang Diproses')->count();
        $sktmProgress = IncapacityCertifications::where('status', 'Sedang Diproses')->count();
        $skiProgress = Permits::where('status', 'Sedang Diproses')->count();

        $getSuratDiteruskan = $skuProgress + $skpProgress + $sktmProgress + $skiProgress;

        $skuDitolak = BusinessCertifications::where('status', 'Ditolak')->count();
        $skpDitolak = FuneralCertifications::where('status', 'Ditolak')->count();
        $sktmDitolak = IncapacityCertifications::where('status', 'Ditolak')->count();
        $skiDitolak = Permits::where('status', 'Ditolak')->count();

        $getSuratDitolak = $skuDitolak + $skpDitolak + $sktmDitolak + $skiDitolak;

        $skuSelesai = BusinessCertifications::where('status', 'Selesai Diproses')->count();
        $skpSelesai = FuneralCertifications::where('status', 'Selesai Diproses')->count();
        $sktmSelesai = IncapacityCertifications::where('status', 'Selesai Diproses')->count();
        $skiSelesai = Permits::where('status', 'Selesai Diproses')->count();

        $getSuratSelesai = $skuSelesai + $skpSelesai + $sktmSelesai + $skiSelesai;

        $totalSurat = $sku + $skp + $sktm + $ski;
        return view('pages.lurah.dashboard', compact('dataUser', 'sku', 'skp', 'sktm', 'ski', 'totalSurat', 'getSuratDiteruskan', 'getSuratDitolak', 'getSuratSelesai'));
    }

    public function getLaporan(Request $request)
    {
        if (request()->ajax()) {
            $query = Letter::with('user.userDetails', 'business', 'funeral', 'incapacity', 'permits')
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
                })->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('tahun', function ($item) {
                    foreach ($item->business as $business) {
                        return $business->created_at->isoFormat('Y');
                    }
                    foreach ($item->funeral as $funeral) {
                        return $funeral->created_at->isoFormat('Y');
                    }
                    foreach ($item->incapacity as $incapacity) {
                        return $incapacity->created_at->isoFormat('Y');
                    }
                    foreach ($item->permits as $permits) {
                        return $permits->created_at->isoFormat('Y');
                    }
                })
                ->editColumn('nik', function ($item) {
                    return $item->user->userDetails->nik;
                })
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('created_at', function ($item) {
                    foreach ($item->business as $business) {
                        return $business->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->funeral as $funeral) {
                        return $funeral->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->incapacity as $incapacity) {
                        return $incapacity->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->permits as $permits) {
                        return $permits->created_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                })
                ->editColumn('updated_at', function ($item) {
                    foreach ($item->business as $business) {
                        return $business->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->funeral as $funeral) {
                        return $funeral->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->incapacity as $incapacity) {
                        return $incapacity->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                    foreach ($item->permits as $permits) {
                        return $permits->updated_at->isoFormat('D MMMM Y' . ' ' . 'H:mm');
                    }
                })
                ->rawColumns(['created_at', 'updated_at', 'nik', 'nama', 'tahun'])
                ->make(true);
        }

        // $month = Letter::with('user.userDetails')->selectRaw('MONTH(created_at) month')->groupBy('month')->get();
        // $year = Letter::with('user.userDetails')->selectRaw('YEAR(created_at) year')->groupBy('year')->get();

        // make sure to use the right syntax for your query builder and model relationships (if you have any) and make sure you have the right table names in your database.
        $months = Letter::whereHas('business', function ($query) {
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
            })
            ->selectRaw('MONTH(created_at) month')
            ->groupBy('month')
            ->get();
        // ->get();



        // dd($months->toArray());

        return view('pages.lurah.laporan', compact('months'));
    }


    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::with('userDetails')->whereIn('roles', ['User', 'Staff'])->where('status_account', 'verifikasi')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('phone', function ($item) {
                    return $item->userDetails->phone ?? '-';
                })
                ->editColumn('address', function ($item) {
                    return $item->userDetails->address ?? '-';
                })
                ->rawColumns(['address', 'phone', 'address'])
                ->make(true);
        }
        return view('pages.lurah.penduduk');
    }

    public function filterLaporanBulanan(Request $request)
    {

        if (request()->ajax()) {

            // $months = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])->whereMonth('created_at', $request->month)->get();


            $months = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])
                ->whereHas('business', function ($query) use ($request) {
                    $query->whereMonth('created_at', $request->month);
                })
                ->orWhereHas('funeral', function ($query) use ($request) {
                    $query->whereMonth('created_at', $request->month);
                })
                ->orWhereHas('incapacity', function ($query) use ($request) {
                    $query->whereMonth('created_at', $request->month);
                })
                ->orWhereHas('permits', function ($query) use ($request) {
                    $query->whereMonth('created_at', $request->month);
                })->get();

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

    public function showMonth(Request $request)
    {
        $month = Letter::with('user.userDetails')->selectRaw('MONTH(created_at) month')->groupBy('month')->get();
        $year = Letter::with('user.userDetails')->selectRaw('YEAR(created_at) year')->groupBy('year')->get();

        return view('pages.lurah.laporan', [
            'months' => $month,
            'years' => $year
        ]);
    }

    public function filterLaporanTahunan(Request $request)
    {
        if (request()->ajax()) {

            // $years = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])->whereYear('created_at', $request->year)->get();
            $years = Letter::whereHas('business', function ($query) use ($request) {
                $query->whereYear('created_at', Carbon::parse($request->year))->orWhere('status', 'Selesai Diproses');
            })->orWhereHas('funeral', function ($query) use ($request) {
                $query->whereYear('created_at', Carbon::parse($request->year))->orWhere('status', 'Selesai Diproses');
            })->orWhereHas('incapacity', function ($query) use ($request) {
                $query->whereYear('created_at', Carbon::parse($request->year))->orWhere('status', 'Selesai Diproses');
            })->orWhereHas('permits', function ($query) use ($request) {
                $query->whereYear('created_at', Carbon::parse($request->year))->orWhere('status', 'Selesai Diproses');
            })->get();

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

            $getMonthYear = Letter::with(['business', 'permits', 'incapacity', 'funeral', 'user.userDetails'])->selectRaw('MONTH(created_at) month, YEAR(created_at) year')->whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->get();

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
