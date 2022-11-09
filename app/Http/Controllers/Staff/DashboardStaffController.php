<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardStaffController extends Controller
{
    public function index()
    {
        $dataUser = User::where('roles', 'user')->count();
        $getSurat = Letter::count();
        $getSuratDiteruskan = Letter::where('status', 'Sedang Diproses')->count();
        $getSuratDisetujui = Letter::where('status', 'Selesai Diproses')->count();
        $skuStaff = Letter::where('jenis_surat', 'SKU')->where('status', 'Belum Diproses')->count();
        $skpStaff = Letter::where('jenis_surat', 'SKP')->where('status', 'Belum Diproses')->count();
        $sktmStaff = Letter::where('jenis_surat', 'SKTM')->where('status', 'Belum Diproses')->count();
        $skiStaff = Letter::where('jenis_surat', 'SKI')->where('status', 'Belum Diproses')->count();
        return view('pages.staff.dashboard', compact('dataUser', 'getSurat', 'getSuratDiteruskan', 'getSuratDisetujui', 'skuStaff', 'skpStaff', 'sktmStaff', 'skiStaff'));
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::where('roles', 'User')->get();

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
        return view('pages.staff.penduduk');
    }
}
