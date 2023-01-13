<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        // $getSurat = Letter::where('users_id', Auth::user()->id)->count();
        // $getSuratDiproses = Letter::where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        // $getSuratDitolak = Letter::where('users_id', Auth::user()->id)->where('status', 'Ditolak')->count();
        // $getSuratDisetujui = Letter::where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses')->count();
        // cek semua field detail user kosong atau tidak
        return view('pages.user.dashboard');
    }

    public function getPenolakan(Request $request)
    {
        if (request()->ajax()) {
            $where = array('letters.id' => $request->id);
            $result = Letter::where($where)->first();
            if ($result) {
                return Response()->json($result);
            } else {
                return Response()->json(['error' => 'Data tidak ditemukan!']);
            }
        } else {
            $result = (['status' => false, 'message' => 'Maaf, akses ditolak!']);
        }
        return Response()->json($result);
    }
}
