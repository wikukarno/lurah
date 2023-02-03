<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\Letter;
use App\Models\Permits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $getBusiness = BusinessCertifications::where('users_id', Auth::user()->id)->count();
        $getFunerals = FuneralCertifications::where('users_id', Auth::user()->id)->count();
        $getIncapacity = IncapacityCertifications::where('users_id', Auth::user()->id)->count();
        $getPermits = Permits::where('users_id', Auth::user()->id)->count();

        $letterRejected = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
            ->whereHas('business', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Ditolak');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Ditolak');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Ditolak');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Ditolak');
            });

        $letterOnProgress = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
            ->whereHas('business', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses');
            });

        $letterComplete = Letter::with(['business', 'funeral', 'incapacity', 'permits'])
            ->whereHas('business', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('funeral', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('incapacity', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses');
            })
            ->orWhereHas('permits', function ($query) {
                $query->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses');
            });


        $getSuratDitolak = $letterRejected->count();
        $getSuratDiproses = $letterOnProgress->count();
        $getSuratSelesai = $letterComplete->count();

        $totalSurat = $getBusiness + $getFunerals + $getIncapacity + $getPermits;

        return view('pages.user.dashboard', compact('totalSurat', 'getSuratDitolak', 'getSuratDiproses', 'getSuratSelesai'));
    }

    public function getPenolakanSktm(Request $request)
    {
        if (request()->ajax()) {
            $where = array('incapacity_certifications.id' => $request->id);
            $result = IncapacityCertifications::where($where)->first();
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
    public function getPenolakanSku(Request $request)
    {
        if (request()->ajax()) {
            $where = array('business_certifications.id' => $request->id);
            $result = BusinessCertifications::where($where)->first();
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
    public function getPenolakanSki(Request $request)
    {
        if (request()->ajax()) {
            $where = array('permits.id' => $request->id);
            $result = Permits::where($where)->first();
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
    public function getPenolakanSkp(Request $request)
    {
        if (request()->ajax()) {
            $where = array('incapacity_certifications.id' => $request->id);
            $result = IncapacityCertifications::where($where)->first();
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
