<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\SKI;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LurahPermitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showSkiLurahDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = SKI::with('user')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('surat_rtrw', function ($item) {
                    return '
                        <a href="' . asset('storage/' . $item->surat_rtrw) . '" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    ';
                })

                ->editColumn('action', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('ski-lurah.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="' . route('staff.get-tolak-sku', $item->id) . '" class="btn btn-sm btn-danger mx-1">Tolak</a>

                        ';
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
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }

        return view('pages.lurah.ski.show-surat');
    }
    
    public function index()
    {
        if (request()->ajax()) {
            $query = SKI::with([
                'user'
            ])->where('posisi', 'lurah')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Selesai Diproses') {
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
                            <div class="d-flex">
                                <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <form id="form-setujui" method="POST">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="id" value="' . $item->id . '">
                                    <button type="submit" id="btnSetujui" class="btn btn-sm btn-success mx-1">Setujui</button>
                                </form>
                            </div>

                            <script>
                                $("#form-setujui").submit(function (e) {
                                    e.preventDefault();
                                    var id = $("input[name=id]").val();

                                    Swal.fire({
                                        title: "Apakah anda yakin?",
                                        text: "Ingin Setujui surat ini?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Ya, Setujui!",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                url: "' . route('ski-lurah.setujui') . '",
                                                type: "POST",
                                                data: {
                                                    id: id,
                                                    _token: "' . csrf_token() . '"
                                                },
                                                success: function (data) {
                                                    Swal.fire(
                                                        "Berhasil!",
                                                        "Surat berhasil disetujui",
                                                        "success"
                                                    )
                                                    $("#tb_ski_lurah_belum_diproses").DataTable().ajax.reload();
                                                    $("#tb_ski_lurah_ditolak").DataTable().ajax.reload();
                                                    $("#tb_ski_lurah_sedang_diproses").DataTable().ajax.reload();
                                                    $("#tb_ski_lurah_selesai_diproses").DataTable().ajax.reload();
                                                }
                                            });
                                        }
                                    })
                                });
                            </script>
                        ';
                    } elseif ($item->status == 'Selesai') {
                        return '
                            <a href="#" class="btn btn-sm btn-outline-success">
                                Cetak
                            </a>
                        ';
                    } else {
                        return '
                            <div class="d-flex">
                                <a href="#" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <form id="form-setujui" method="POST">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="id" value="' . $item->id . '">
                                    <button type="submit" id="btnSetujui" class="btn btn-sm btn-success mx-1">Setujui</button>
                                </form>
                            </div>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.lurah.ski.index');
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = SKI::with([
                'user',
            ])->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Selesai Diproses') {
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
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('ski-lurah.cetak-ski', $item->id) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary" onclick="lampiranSki(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSki(' . $item->id . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('ski-lurah.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSki(' . $item->id . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.lurah.ski.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            $query = SKI::with([
                'user',
            ])->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Selesai Diproses') {
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
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary" onclick="lampiranSki(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="showRejectSki(' . $item->id . ')">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('ski-lurah.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSki(' . $item->id . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.lurah.ski.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $query = SKI::with([
                'user',
            ])->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Selesai Diproses') {
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
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary" onclick="lampiranSki(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="' . route('ski-lurah.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('ski-lurah.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSki(' . $item->id . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.lurah.ski.index');
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
        $item = SKI::with(['user'])->where('id', $id)->findOrFail($id);

        return view('pages.lurah.ski.show', [
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
        $item = SKI::findOrFail($id);
        $data = Laporan::findOrFail($item->id_laporan);
        $data->update([
            'status' => 'Selesai Diproses',
            'posisi' => 'Staff',
        ]);
        
        $item->update([
            'status' => 'Selesai Diproses',
            'posisi' => 'staff',
        ]);

        if($item){
            Alert::success('Berhasil', 'Surat Keterangan Izin Berhasil Disetujui');
            return redirect()->route('ski-lurah.index');
        }else{
            Alert::error('Gagal', 'Surat Keterangan Izin Gagal Disetujui');
            return redirect()->route('ski-lurah.index');
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

    public function setujui(Request $request)
    {
        $item = SKI::findOrFail($request->id);
        $data = Laporan::findOrFail($item->id_laporan);

        $data->update([
            'status' => 'Selesai Diproses',
            'posisi' => 'Staff',
        ]);

        $item->update([
            'id' => $request->id,
            'status' => 'Selesai Diproses',
            'posisi' => 'staff',
        ]);

        if ($item) {
            Alert::success('Berhasil', 'Surat Keterangan Izin Berhasil Disetujui');
            return redirect()->route('sku-lurah.index');
        } else {
            Alert::error('Gagal', 'Surat Keterangan Izin Gagal Disetujui');
            return redirect()->route('sku-lurah.index');
        }
    }

}
