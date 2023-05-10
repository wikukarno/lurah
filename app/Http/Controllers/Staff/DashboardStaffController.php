<?php

namespace App\Http\Controllers\Staff;

use App\Models\SKI;
use App\Models\SKP;
use App\Models\SKU;
use App\Models\SKTM;
use App\Models\User;
use App\Models\Letter;
use App\Models\Laporan;
use App\Models\Permits;
use Illuminate\Http\Request;
use App\Models\KategoriSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FuneralCertifications;
use App\Models\BusinessCertifications;
use Illuminate\Support\Facades\Storage;
use App\Models\IncapacityCertifications;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardStaffController extends Controller
{
    public function index()
    {
        $dataUser = User::where('roles', 'user')->where('status_account', 'verifikasi')->count();
        $sku = SKU::count();
        $skp = SKP::count();
        $sktm = SKTM::count();
        $ski = SKI::count();

        $skuMasuk = SKU::where('status', 'Belum Diproses')->count();
        $skpMasuk = SKP::where('status', 'Belum Diproses')->count();
        $sktmMasuk = SKTM::where('status', 'Belum Diproses')->count();
        $skiMasuk = SKI::where('status', 'Belum Diproses')->count();

        $skuProses = SKU::where('status', 'Sedang Diproses')->count();
        $skpProses = SKP::where('status', 'Sedang Diproses')->count();
        $sktmProses = SKTM::where('status', 'Sedang Diproses')->count();
        $skiProses = SKI::where('status', 'Sedang Diproses')->count();

        $skuSelesai = SKU::where('status', 'Selesai Diproses')->count();
        $skpSelesai = SKP::where('status', 'Selesai Diproses')->count();
        $sktmSelesai = SKTM::where('status', 'Selesai Diproses')->count();
        $skiSelesai = SKI::where('status', 'Selesai Diproses')->count();

        $skuDitolak = SKU::where('status', 'Ditolak')->count();
        $skpDitolak = SKP::where('status', 'Ditolak')->count();
        $sktmDitolak = SKTM::where('status', 'Ditolak')->count();
        $skiDitolak = SKI::where('status', 'Ditolak')->count();


        // $suratProgress = Laporan::with(['business', 'funeral', 'incapacity', 'permits'])
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

        // $suratDitolak = Laporan::with(['business', 'funeral', 'incapacity', 'permits'])
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

        // $suratSelesai = Laporan::with(['business', 'funeral', 'incapacity', 'permits'])
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

        $totalSuratProses = Laporan::where('status', 'Sedang Diproses')->count();
        $totalSuratSelesai = Laporan::where('status', 'Selesai Diproses')->count();
        $totalSuratDitolak = Laporan::where('status', 'Ditolak')->count();
        

        return view('pages.staff.dashboard', compact('dataUser', 'totalSurat', 'sku', 'skp', 'sktm', 'ski', 'skuMasuk', 'skpMasuk', 'sktmMasuk', 'skiMasuk', 'skuProses', 'skpProses', 'sktmProses', 'skiProses', 'skuSelesai', 'skpSelesai', 'sktmSelesai', 'skiSelesai', 'skuDitolak', 'skpDitolak', 'sktmDitolak', 'skiDitolak', 'totalSuratProses', 'totalSuratSelesai', 'totalSuratDitolak'));
    }

    public function getPenduduk()
    {
        if (request()->ajax()) {
            $query = User::where('roles', 'User')->where('status_account', 'verifikasi')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('no_telepon', function ($item) {
                    return $item->no_telepon ?? '-';
                })
                ->editColumn('alamat', function ($item) {
                    return $item->alamat ?? '-';
                })
                ->rawColumns(['alamat', 'no_telepon', 'action', 'alamat'])
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
                ->editColumn('foto', function ($item) {
                    if ($item->foto != null) {
                        return '<img src="' . Storage::url($item->foto) . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    } else {
                        return '<img src="' . asset('assets/images/user.png') . '" class="img-fluid rounded-circle" width="40px" height="40px">';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group d-flex">
                            <a href="' . route('staff.detail-verifikasi', $item->id_user) . '" class="btn btn-sm btn-primary mx-1">Detail</a>
                            <form id="form-verifikasi-pengguna" method="POST">
                                ' . csrf_field() . '
                                <input type="hidden" name="id_user" value="' . $item->id_user . '">
                                <button type="submit" id="btnVerifikasi" class="btn btn-sm btn-success mx-1">Verifikasi</button>
                            </form>

                            <a href="' . route('staff.get-tolak', $item->id_user) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>
                        </div>
                        <script>
                            $("#form-verifikasi-pengguna").submit(function (e) {
                                e.preventDefault();
                                var id = $("input[name=id_user]").val();

                                Swal.fire({
                                    title: "Apakah anda yakin?",
                                    text: "Ingin memverifikasi pengguna ini",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Ya, verifikasi!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "' . route('staff.verifikasi') . '",
                                            type: "POST",
                                            data: {
                                                id_user: id,
                                                _token: "' . csrf_token() . '"
                                            },
                                            success: function (data) {
                                                if (data.status == "success") {
                                                    Swal.fire(
                                                        "Berhasil!",
                                                        "Berhasil memverifikasi pengguna",
                                                        "success"
                                                    )
                                                    $("#tb_verifikasi_penduduk").DataTable().ajax.reload();
                                                } else {
                                                    Swal.fire({
                                                        title: "Gagal!",
                                                        text: data.message,
                                                        icon: "error",
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    });
                                                }
                                            }
                                        });
                                    }
                                })
                            });
                        </script>
                    ';
                })
                ->rawColumns(['alamat', 'foto', 'action'])
                ->make(true);
        }
        return view('pages.staff.verifikasi-penduduk');
    }

    public function verifikasi(Request $request)
    {
        $data = User::findOrFail($request->id_user);
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
        $users = User::with('userDetails')->where('id_user', $id)->first();
        return view('pages.staff.detail-verifikasi', compact('data', 'users'));
    }


    public function getTolak($id)
    {
        $data = User::findOrFail($id);
        return view('pages.staff.tolak-verifikasi', compact('data'));
    }

    public function tolakVerifikasi(Request $request, $id)
    {
        // $data = User::findOrFail($request->id);
        // $data->status_account = 'ditolak';
        // $data->alasan_penolakan = $request->alasan_penolakan;
        // $data->save();

        $data = $request->all();
        $data['status_account'] = 'ditolak';

        $tolak = User::findOrFail($id);
        $tolak->update($data);

        if ($data) {
            Alert::success('Berhasil', 'Verifikasi pengguna ditolak');
            return redirect()->route('staff.verifikasi-penduduk');
        } else {
            Alert::error('Gagal', 'Verifikasi pengguna gagal ditolak');
            return redirect()->route('staff.verifikasi-penduduk');
        }
    }

    public function allSurat()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = Laporan::with('user')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('id_kategori_surat', function ($item) {
                    $category = KategoriSurat::where('id', $item->id_kategori_surat)->first();
                    if ($item->id_kategori_surat == $category->id) {
                        return $category->nama;
                    }
                })

                ->editColumn('nama', function ($item) {
                    return $item->nama != null ? $item->nama : $item->user->nama;
                })

                ->editColumn('action', function ($item) {
                    $sku = SKU::where('id_laporan', $item->id)->first();
                    $ski = SKI::where('id_laporan', $item->id)->first();
                    $sktm = SKTM::where('id_laporan', $item->id)->first();
                    $skp = SKP::where('id_laporan', $item->id)->first();
                    if ($item->status == 'Belum Diproses') {
                        if($sku != null){
                            return '
                                <a href="' . route('sku-staff.show', $sku->id) . '" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <form action="' . route('sku-staff.update', $sku->id) . '" method="POST" class="d-inline">
                                ' . method_field('PUT') . '    
                                ' . csrf_field() . '
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        Teruskan
                                    </button>
                                </form>

                                <a href="' . route('staff.get-tolak-sku', $sku->id) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                            ';
                        }elseif ($ski != null) {
                            return '
                                    <a href="' . route('ski-staff.show', $ski->id) . '" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="' . route('ski-staff.update', $ski->id) . '" method="POST" class="d-inline">
                                    ' . method_field('PUT') . '    
                                    ' . csrf_field() . '
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Teruskan
                                        </button>
                                    </form>

                                    <a href="' . route('staff.get-tolak-ski', $ski->id) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                                ';
                        }elseif ($sktm != null) {
                            return '
                                    <a href="' . route('sktm-staff.show', $sktm->id) . '" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="' . route('sktm-staff.update', $sktm->id) . '" method="POST" class="d-inline">
                                    ' . method_field('PUT') . '    
                                    ' . csrf_field() . '
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Teruskan
                                        </button>
                                    </form>

                                    <a href="' . route('staff.get-tolak-sktm', $sktm->id) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                                ';
                        }elseif ($skp != null){
                            return '
                                    <a href="' . route('skp-staff.show', $skp->id) . '" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="' . route('skp-staff.update', $skp->id) . '" method="POST" class="d-inline">
                                    ' . method_field('PUT') . '    
                                    ' . csrf_field() . '
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Teruskan
                                        </button>
                                    </form>

                                    <a href="' . route('staff.get-tolak-skp', $skp->id) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                                ';
                        }
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '
                            <span class="badge badge-warning">Sedang Diproses</span>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <span class="badge badge-success">
                                Selesai Diproses
                            </span>
                        ';
                    } else {
                        $sku = SKU::where('id_laporan', $item->id)->first();
                        $ski = SKI::where('id_laporan', $item->id)->first();
                        $sktm = SKTM::where('id_laporan', $item->id)->first();
                        $skp = SKP::where('id_laporan', $item->id)->first();
                        if ($sku != null) {
                            return '
                                <a href="' . route('sku-staff.show', $sku->id) . '" class="badge badge-danger">
                                    Ditolak
                                </a>
                            ';
                        } elseif ($ski != null) {
                            return '
                                <a href="' . route('ski-staff.show', $ski->id) . '" class="badge badge-danger">
                                    Ditolak
                                </a>
                            ';
                        } elseif ($sktm != null) {
                            return '
                                <a href="' . route('sktm-staff.show', $sktm->id) . '" class="badge badge-danger">
                                    Ditolak
                                </a>
                            ';
                        } elseif ($skp != null) {
                            return '
                                <a href="' . route('skp-staff.show', $skp->id) . '" class="badge badge-danger">
                                    Ditolak
                                </a>
                            ';
                        }
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }

        return view('pages.staff.semua-surat');
    }
}
