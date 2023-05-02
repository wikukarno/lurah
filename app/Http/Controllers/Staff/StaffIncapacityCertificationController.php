<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\IncapacityCertifications;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\SKTM;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StaffIncapacityCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = SKTM::with([
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
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('sktm-staff.cetak-sktm', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary" onclick="lampiranSktm(' . $item->id_surat_tidak_mampu . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSktm(' . $item->id_surat_tidak_mampu . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('sktm-staff.update', $item->id_surat_tidak_mampu) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="' . route('staff.get-tolak-sktm', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.sktm.index');
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = SKTM::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
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
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('sktm-staff.cetak-sktm', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary" onclick="lampiranSktm(' . $item->id_surat_tidak_mampu . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSktm(' . $item->id_surat_tidak_mampu . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('sktm-staff.update', $item->id_surat_tidak_mampu) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKtm(' . $item->id_surat_tidak_mampu . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action', 'nama'])
                ->make(true);
        }
        return view('pages.staff.sktm.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            $query = SKTM::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
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
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('sktm-staff.cetak-sktm', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary" onclick="lampiranSktm(' . $item->id_surat_tidak_mampu . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSktm(' . $item->id_surat_tidak_mampu . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('sktm-staff.update', $item->id_surat_tidak_mampu) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKtm(' . $item->id_surat_tidak_mampu . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action', 'nama'])
                ->make(true);
        }
        return view('pages.staff.sktm.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $query = SKTM::with([
                'user.userDetails',
                'letter',
            ])->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
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
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('sktm-staff.cetak-sktm', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary" onclick="lampiranSktm(' . $item->id_surat_tidak_mampu . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('sktm-staff.show', $item->id_surat_tidak_mampu) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('sktm-staff.update', $item->id_surat_tidak_mampu) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKtm(' . $item->id_surat_tidak_mampu . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action', 'nama'])
                ->make(true);
        }
        return view('pages.staff.sktm.index');
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
        $item = SKTM::with(['user.userDetails', 'letter'])->where('id_surat_tidak_mampu', $id)->findOrFail($id);

        return view('pages.staff.sktm.show', [
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
        $item = SKTM::findOrFail($id);
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
            Alert::success('Berhasil', 'Surat Keterangan Tidak Mampu berhasil diteruskan');
            return redirect()->route('sktm-staff.index');
        }else{
            Alert::error('Gagal', 'Surat Keterangan Tidak Mampu gagal diteruskan');
            return redirect()->route('sktm-staff.index');
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

    public function getTolakSktm($id)
    {
        $data = SKTM::findOrFail($id);
        return view('pages.staff.sktm.tolak', compact('data'));
    }

    public function tolakSktm(Request $request)
    {
        $sktm = SKTM::findOrFail($request->id_surat_tidak_mampu);
        $data = Laporan::findOrFail($sktm->id_laporan);
        $data->update([
            'status' => 'Ditolak',
        ]);
        $sktm->status = 'Ditolak';
        $sktm->alasan_penolakan = $request->alasan_penolakan;
        $sktm->save();

        if ($sktm) {
            Alert::success('Berhasil', 'Surat Keterangan Tidak Mampu Berhasil Ditolak');
            return redirect()->route('sktm-staff.index');
        } else {
            Alert::error('Gagal', 'Surat Keterangan Tidak Mampu Gagal Ditolak');
            return redirect()->route('sktm-staff.index');
        }
    }

    public function showTolakSktm(Request $request)
    {
        $data = SKTM::findOrFail($request->id);
        return response()->json($data);
    }
}
