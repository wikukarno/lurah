<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardStaffController extends Controller
{
    public function index()
    {
        $dataUser = User::where('roles', 'user')->where('status_account', 'verifikasi')->count();
        $sku = BusinessCertifications::count();
        $skp = FuneralCertifications::count();
        $sktm = IncapacityCertifications::count();
        $ski = Permits::count();

        $skuMasuk = BusinessCertifications::where('status', 'Belum Diproses')->count();
        $skpMasuk = FuneralCertifications::where('status', 'Belum Diproses')->count();
        $sktmMasuk = IncapacityCertifications::where('status', 'Belum Diproses')->count();
        $skiMasuk = Permits::where('status', 'Belum Diproses')->count();

        $skuProses = BusinessCertifications::where('status', 'Sedang Diproses')->count();
        $skpProses = FuneralCertifications::where('status', 'Sedang Diproses')->count();
        $sktmProses = IncapacityCertifications::where('status', 'Sedang Diproses')->count();
        $skiProses = Permits::where('status', 'Sedang Diproses')->count();

        $skuSelesai = BusinessCertifications::where('status', 'Selesai Diproses')->count();
        $skpSelesai = FuneralCertifications::where('status', 'Selesai Diproses')->count();
        $sktmSelesai = IncapacityCertifications::where('status', 'Selesai Diproses')->count();
        $skiSelesai = Permits::where('status', 'Selesai Diproses')->count();

        $skuDitolak = BusinessCertifications::where('status', 'Ditolak')->count();
        $skpDitolak = FuneralCertifications::where('status', 'Ditolak')->count();
        $sktmDitolak = IncapacityCertifications::where('status', 'Ditolak')->count();
        $skiDitolak = Permits::where('status', 'Ditolak')->count();


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


        $totalSurat = $sku + $skp + $sktm + $ski;

        $totalSuratProses = Letter::where('status', 'Sedang Diproses')->count();
        $totalSuratSelesai = Letter::where('status', 'Selesai Diproses')->count();
        $totalSuratDitolak = Letter::where('status', 'Ditolak')->count();
        

        return view('pages.staff.dashboard', compact('dataUser', 'totalSurat', 'sku', 'skp', 'sktm', 'ski', 'skuMasuk', 'skpMasuk', 'sktmMasuk', 'skiMasuk', 'skuProses', 'skpProses', 'sktmProses', 'skiProses', 'skuSelesai', 'skpSelesai', 'sktmSelesai', 'skiSelesai', 'skuDitolak', 'skpDitolak', 'sktmDitolak', 'skiDitolak', 'totalSuratProses', 'totalSuratSelesai', 'totalSuratDitolak'));
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::with(['userDetails'])->where('roles', 'User')->where('status_account', 'verifikasi')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('phone', function ($item) {
                    return $item->userDetails->phone ?? '-';
                })
                ->editColumn('address', function ($item) {
                    return $item->userDetails->address ?? '-';
                })
                ->rawColumns(['address', 'phone', 'action', 'address'])
                ->make(true);
        }
        return view('pages.staff.penduduk');
    }

    public function verifikasiPenduduk()
    {
        if (request()->ajax()) {
            $query = User::with('userDetails')->where('roles', 'User')->where('status_account', 'pending')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('avatar', function ($item) {
                    if ($item->userDetails->avatar != null) {
                        return '<img src="' . Storage::url($item->userDetails->avatar) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('staff.detail-verifikasi', $item->id) . '" class="btn btn-sm btn-primary">Detail</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="verifikasiPengguna(' . $item->id . ')">Verifikasi</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakVerifikasi(' . $item->id . ')">Tolak</a>
                        </div>
                    ';
                })
                ->rawColumns(['alamat', 'avatar', 'action'])
                ->make(true);
        }
        return view('pages.staff.verifikasi-penduduk');
    }

    public function verifikasi(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->status_account = 'verifikasi';
        $data->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil verifikasi pengguna'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal verifikasi pengguna'
            ]);
        }
    }

    public function detailVerifikasi($id)
    {
        $data = User::findOrFail($id);
        $users = User::with('userDetails')->where('id', $id)->first();
        return view('pages.staff.detail-verifikasi', compact('data', 'users'));
    }

    public function tolakVerifikasi(Request $request)
    {
        $data = User::findOrFail($request->id_penolakan);
        $data->status_account = 'ditolak';
        $data->alasan_penolakan = $request->alasan_penolakan;
        $data->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil tolak verifikasi pengguna'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal tolak verifikasi pengguna'
            ]);
        }
    }
}
