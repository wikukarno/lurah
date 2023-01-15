<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardStaffController extends Controller
{
    public function index()
    {
        $dataUser = User::where('roles', 'user')->count();
        $sku = BusinessCertifications::count();
        return view('pages.staff.dashboard', compact('dataUser', 'sku'));
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::with(['userDetails'])->where('roles', 'User')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('avatar', function ($item) {
                    if ($item->userDetails->avatar != null) {
                        return '<img src="' . Storage::url($item->userDetails->avatar) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('phone', function($item) {
                    if ($item->userDetails->phone == null) {
                        return '-';
                    } else {
                        return $item->userDetails->phone;
                    }
                })
                ->editColumn('address', function ($item) {
                    if ($item->userDetails->address == null) {
                        return '-';
                    } else {
                        return $item->userDetails->address;
                    }
                })
                ->rawColumns(['address', 'avatar'])
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
