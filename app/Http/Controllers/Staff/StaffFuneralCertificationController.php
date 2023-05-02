<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\FuneralCertifications;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\SKP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StaffFuneralCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = SKP::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '<span class="badge badge-pill badge-danger">' . $item->status . '</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">' . $item->status . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-warning disabled">
                                Diteruskan
                            </a>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('skp-staff.cetak-skp', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary" onclick="lampiranSkp(' . $item->id_surat_keterangan_pemakaman . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSkp(' . $item->id_surat_keterangan_pemakaman . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('skp-staff.update', $item->id_surat_keterangan_pemakaman) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="' . route('staff.get-tolak-skp', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.skp.index');
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = SKP::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '<span class="badge badge-pill badge-danger">' . $item->status . '</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">' . $item->status . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-warning disabled">
                                Diteruskan
                            </a>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('skp-staff.cetak-skp', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary" onclick="lampiranSkp(' . $item->id_surat_keterangan_pemakaman . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSkp(' . $item->id_surat_keterangan_pemakaman . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('skp-staff.update', $item->id_surat_keterangan_pemakaman) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKP(' . $item->id_surat_keterangan_pemakaman . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.skp.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            $query = SKP::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '<span class="badge badge-pill badge-danger">' . $item->status . '</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">' . $item->status . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-warning disabled">
                                Diteruskan
                            </a>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('skp-staff.cetak-skp', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary" onclick="lampiranSkp(' . $item->id_surat_keterangan_pemakaman . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSkp(' . $item->id_surat_keterangan_pemakaman . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('skp-staff.update', $item->id_surat_keterangan_pemakaman) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKP(' . $item->id_surat_keterangan_pemakaman . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.skp.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $query = SKP::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '<span class="badge badge-pill badge-danger">' . $item->status . '</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">' . $item->status . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-warning disabled">
                                Diteruskan
                            </a>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('skp-staff.cetak-skp', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary" onclick="lampiranSkp(' . $item->id_surat_keterangan_pemakaman . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('skp-staff.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('skp-staff.update', $item->id_surat_keterangan_pemakaman) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKP(' . $item->id_surat_keterangan_pemakaman . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.skp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = SKP::with(['user.userDetails', 'letter'])->where('id_surat_keterangan_pemakaman', $id)->findOrFail($id);

        return view('pages.staff.skp.show', [
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = SKP::findOrFail($id);
        $data = Laporan::findOrFail($item->id_laporan);
        $data->update([
            'status' => 'Sedang Diproses',
            'posisi' => 'lurah',
        ]);
        $item->update([
            'status' => 'Sedang Diproses',
            'posisi' => 'lurah',
        ]);

        if($item){
            Alert::success('Berhasil', 'Surat Keterangan Pemakaman berhasil diteruskan');
            return redirect()->route('skp-staff.index');
        }else{
            Alert::error('Gagal', 'Surat Keterangan Pemakaman gagal diteruskan');
            return redirect()->route('skp-staff.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTolakSkp($id)
    {
        $data = SKP::findOrFail($id);
        return view('pages.staff.skp.tolak', compact('data'));
    }

    public function tolakSkp(Request $request)
    {
        $skp = SKP::findOrFail($request->id_surat_keterangan_pemakaman);
        $data = Laporan::findOrFail($skp->id_laporan);
        $data->update([
            'status' => 'Ditolak',
        ]);
        $skp->status = 'Ditolak';
        $skp->alasan_penolakan = $request->alasan_penolakan;
        $skp->save();


        if ($skp) {
            Alert::success('Berhasil', 'Surat Keterangan Pemakaman Ditolak');
            return redirect()->route('skp-staff.index');
        } else {
            Alert::error('Gagal', 'Surat Keterangan Pemakaman Gagal Ditolak');
            return redirect()->route('skp-staff.index');
        }
    }

}
