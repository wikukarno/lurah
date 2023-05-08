<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\KategoriSurat;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\SKI;
use App\Models\SKP;
use App\Models\SKTM;
use App\Models\SKU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        // dapatkan semua data surat yang dimiliki user yang sedang login
        $getBusinessOnProgress = SKU::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getBusinessFinished = SKU::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();
        $getBusinessRejected = SKU::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();

        $getFuneralsOnProgress = SKP::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getFuneralsFinished = SKP::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();
        $getFuneralsRejected = SKP::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();

        $getIncapacityOnProgress = SKTM::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getIncapacityFinished = SKTM::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();
        $getIncapacityRejected = SKTM::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();


        $getPermitsOnProgress = SKI::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getPermitsFinished = SKI::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();
        $getPermitsRejected = SKI::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();

        // dapatkan semua data surat yang dimiliki user yang sedang login berdasarkan status
        $getSuratDitolak = Laporan::where('id_user', Auth::user()->id)->where('status', 'Ditolak')->count();
        $getSuratDiproses = Laporan::where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->count();
        $getSuratSelesai = Laporan::where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->count();

        // hitung total surat yang dimiliki user yang sedang login
        $sku = SKU::where('id_user', Auth::user()->id)->count();
        $skp = SKP::where('id_user', Auth::user()->id)->count();
        $sktm = SKTM::where('id_user', Auth::user()->id)->count();
        $ski = SKI::where('id_user', Auth::user()->id)->count();
        $totalSurat = $sku + $skp + $sktm + $ski;

        return view('pages.user.dashboard', compact(
            'totalSurat', 
            'getSuratDitolak', 
            'getSuratDiproses', 
            'getSuratSelesai',
            'getBusinessOnProgress',
            'getBusinessFinished',
            'getBusinessRejected',
            'getFuneralsOnProgress',
            'getFuneralsFinished',
            'getFuneralsRejected',
            'getIncapacityOnProgress',
            'getIncapacityFinished',
            'getIncapacityRejected',
            'getPermitsOnProgress',
            'getPermitsFinished',
            'getPermitsRejected'
        ));
    }

    public function showSuratUserDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = Laporan::with('user')->where('id_user', Auth::user()->id)->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('id_kategori_surat', function($item){
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if($item->id_kategori_surat == $category->id){
                        return $category->nama;
                    }
                })

                ->editColumn('nama', function ($item) {
                   return $item->nama != null ? $item->nama : $item->user->nama;
                })

                ->editColumn('action', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '
                            <span class="badge badge-secondary">Belum Diproses</span>
                        ';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '
                            <span class="badge badge-warning">Sedang Diproses</span>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                        if($category->nama == 'Surat Keterangan Usaha'){
                            return '
                                <a href="javascript:void(0)" class="badge badge-success" onclick="skuSelesaiProses()">
                                    Selesai Diproses
                                </a>
                            ';
                        }elseif($category->nama == 'Surat Keterangan Izin'){
                            return '
                                <a href="javascript:void(0)" class="badge badge-success" onclick="skiSelesaiProses()">
                                    Selesai Diproses
                                </a>
                            ';
                        }elseif($category->nama == 'Surat Keterangan Tidak Mampu'){
                            return '
                                <a href="javascript:void(0)" class="badge badge-success" onclick="sktmSelesaiProses()">
                                    Selesai Diproses
                                </a>
                            ';
                        }elseif($category->nama == 'Surat Keterangan Pemakaman'){
                            return '
                                <a href="javascript:void(0)" class="badge badge-success" onclick="skpSelesaiProses()">
                                    Selesai Diproses
                                </a>
                            ';
                        }
                    } else {
                        $dataSku = SKU::where('id_laporan', $item->id)->first();
                        $dataSkp = SKP::where('id_laporan', $item->id)->first();
                        $dataSktm = SKTM::where('id_laporan', $item->id)->first();
                        $dataSki = SKI::where('id_laporan', $item->id)->first();

                        if($dataSku != null){
                            return '
                                <a href="' . route('sku-user.show', $dataSku->id) . '" class="badge badge-danger mx-1">Ditolak
                                </a>
                            ';
                        }elseif($dataSkp != null){
                            return '
                                <a href="' . route('skp-user.show', $dataSkp->id) . '" class="badge badge-danger mx-1">Ditolak
                                </a>
                            ';
                        }elseif($dataSktm != null){
                            return '
                                <a href="' . route('sktm-user.show', $dataSktm->id) . '" class="badge badge-danger mx-1">Ditolak
                                </a>
                            ';
                        }elseif($dataSki != null){
                            return '
                                <a href="' . route('ski-user.show', $dataSki->id) . '" class="badge badge-danger mx-1">Ditolak
                                </a>
                            ';
                        }
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha', 'id_kategori_surat'])
                ->make(true);
        }

        return view('pages.user.semua-surat');
    }

    public function showSuratDitolakUserDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = Laporan::with('user')->where('id_user', Auth::user()->id)->where('status', 'Ditolak')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })

                ->editColumn('nama', function ($item) {
                   return $item->nama != null ? $item->nama : $item->user->nama;
                })

                ->editColumn('id_kategori_surat', function ($item) {
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if ($item->id_kategori_surat == $category->id) {
                        return $category->nama;
                    }
                })

                ->editColumn('action', function ($item) {
                    $dataSku = SKU::where('id_laporan', $item->id)->first();
                    $dataSkp = SKP::where('id_laporan', $item->id)->first();
                    $dataSktm = SKTM::where('id_laporan', $item->id)->first();
                    $dataSki = SKI::where('id_laporan', $item->id)->first();

                    if($dataSku != null){
                        return '
                            <a href="' . route('sku-user.show', $dataSku->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }elseif($dataSkp != null){
                        return '
                            <a href="' . route('skp-user.show', $dataSkp->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }elseif($dataSktm != null){
                        return '
                            <a href="' . route('sktm-user.show', $dataSktm->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }elseif($dataSki != null){
                        return '
                            <a href="' . route('ski-user.show', $dataSki->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha', 'id_kategori_surat'])
                ->make(true);
        }

        return view('pages.user.surat-ditolak');
    }

    public function showSuratDiprosesUserDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = Laporan::with('user')->where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })

                ->editColumn('nama', function ($item) {
                   return $item->nama != null ? $item->nama : $item->user->nama;
                })

                ->editColumn('id_kategori_surat', function ($item) {
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if ($item->id_kategori_surat == $category->id) {
                        return $category->nama;
                    }
                })

                ->editColumn('action', function ($item) {
                    return '
                        <span class="badge badge-warning">Sedang Diproses</span>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha', 'id_kategori_surat'])
                ->make(true);
        }

        return view('pages.user.surat-diproses');
    }

    public function showSuratSelesaiDiprosesUserDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = Laporan::with('user')->where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })

                ->editColumn('nama', function ($item) {
                   return $item->nama != null ? $item->nama : $item->user->nama;
                })

                ->editColumn('id_kategori_surat', function ($item) {
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if ($item->id_kategori_surat == $category->id) {
                        return $category->nama;
                    }
                })

                ->editColumn('action', function ($item) {
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if($category->nama == 'Surat Keterangan Usaha'){
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="skuSelesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    }elseif($category->nama == 'Surat Keterangan Izin'){
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="skiSelesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    }elseif($category->nama == 'Surat Keterangan Tidak Mampu'){
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="sktmSelesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    }elseif($category->nama == 'Surat Keterangan Pemakaman'){
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="skpSelesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha', 'id_kategori_surat'])
                ->make(true);
        }

        return view('pages.user.surat-selesai');
    }

}
