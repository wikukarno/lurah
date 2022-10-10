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
        $getSuratDiteruskan = Letter::where('status', 'Diteruskan')->count();
        $getSuratDisetujui = Letter::where('status', 'Disetujui')->count();
        return view('pages.staff.dashboard', compact('dataUser', 'getSurat', 'getSuratDiteruskan', 'getSuratDisetujui'));
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
