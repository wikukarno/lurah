<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriSurat;
use App\Models\Laporan;
use App\Models\SKI;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserPermitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showSkiDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = SKI::with('user')->where('id_user', Auth::user()->id)->get();
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
                            <div class="d-flex">
                                <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary mx-1">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="' . route('ski-user.edit', $item->id) . '" class="btn btn-sm btn-info mx-1">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <form id="form-delete-letters" method="POST">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="id" value="' . $item->id . '">
                                    <button type="submit" id="btnDelete" class="btn btn-sm btn-danger mx-1"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>

                            <script>
                                $("#form-delete-letters").submit(function (e) {
                                    e.preventDefault();
                                    var id = $("input[name=id]").val();

                                    Swal.fire({
                                        title: "Apakah anda yakin?",
                                        text: "Ingin menghapus surat ini?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Ya, Hapus!",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                url: "' . route('ski-user.hapus') . '",
                                                type: "POST",
                                                data: {
                                                    id: id,
                                                    _token: "' . csrf_token() . '"
                                                },
                                                success: function (data) {
                                                    Swal.fire(
                                                        "Berhasil!",
                                                        "Surat berhasil dihapus",
                                                        "success"
                                                    )
                                                    $("#tb_ski_user_belum_diproses").DataTable().ajax.reload();
                                                    $("#tb_ski_user_ditolak").DataTable().ajax.reload();
                                                    $("#tb_ski_user_sedang_diproses").DataTable().ajax.reload();
                                                    $("#tb_ski_user_selesai_diproses").DataTable().ajax.reload();
                                                }
                                            });
                                        }
                                    })
                                });
                            </script>
                            
                        ';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '
                            <span class="badge badge-warning">Sedang Diproses</span>
                        ';
                    } elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="selesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    } else {
                        return '
                            <a href="' . route('ski-user.show', $item->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }

        return view('pages.user.ski.show-surat');
    }
    
    public function index()
    {
        if (request()->ajax()) {
            $query = SKI::with('user')->where('id_user', Auth::user()->id)->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="d-flex">
                            <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary mx-1">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('ski-user.edit', $item->id) . '" class="btn btn-sm btn-info mx-1">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <form id="form-delete-letters" method="POST">
                                ' . csrf_field() . '
                                <input type="hidden" name="id" value="' . $item->id . '">
                                <button type="submit" id="btnDelete" class="btn btn-sm btn-danger mx-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>

                        <script>
                            $("#form-delete-letters").submit(function (e) {
                                e.preventDefault();
                                var id = $("input[name=id]").val();

                                Swal.fire({
                                    title: "Apakah anda yakin?",
                                    text: "Ingin menghapus surat ini?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Ya, Hapus!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "' . route('ski-user.hapus') . '",
                                            type: "POST",
                                            data: {
                                                id: id,
                                                _token: "' . csrf_token() . '"
                                            },
                                            success: function (data) {
                                                Swal.fire(
                                                    "Berhasil!",
                                                    "Surat berhasil dihapus",
                                                    "success"
                                                )
                                                $("#tb_ski_user_belum_diproses").DataTable().ajax.reload();
                                                $("#tb_ski_user_ditolak").DataTable().ajax.reload();
                                                $("#tb_ski_user_sedang_diproses").DataTable().ajax.reload();
                                                $("#tb_ski_user_selesai_diproses").DataTable().ajax.reload();
                                            }
                                        });
                                    }
                                })
                            });
                        </script>
                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.user.ski.index', compact('user'));
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = SKI::with('user')->where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.ski.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            $query = SKI::with('user')->where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="selesaiProses()">
                                Selesai Diproses
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        return view('pages.user.ski.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $query = SKI::with('user')->where('id_user', Auth::user()->id)->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.ski.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.ski.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = KategoriSurat::where('nama', 'Surat Keterangan Izin')->first();
        $item = new Laporan();
        $item->id_user = Auth::user()->id;
        $item->id_kategori_surat = $category->id;
        $item->status = 'Belum Diproses';
        $item->posisi = 'Staff';
        $item->nama_izin = $request->nama_izin;
        $item->save();

        $data = SKI::create([
            'id_user' => Auth::user()->id,
            'id_laporan' => $item->id,
            'perihal' => $request->perihal,
            'tujuan_surat' => $request->tujuan_surat,
            'nama_izin' => $request->nama_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'tempat_izin' => $request->tempat_izin,
            'waktu_izin' => $request->waktu_izin,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hiburan' => $request->hiburan,
            'status' => 'Belum Diproses',
            'posisi' => 'Staff',
            'surat_rtrw' => $request->file('surat_rtrw')->store('assets/surat_rtrw', 'public'),
        ]);

        

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil dikirim');
            return redirect()->route('ski-user.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            Alert::error('Gagal', 'Permohonan gagal dikirim');
            return redirect()->route('ski-user.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = SKI::with(['user', 'laporan'])->where('id', $id)->findOrFail($id);

        // return Response()->json($item);
        // dd($item->waktu_izin);
        return view('pages.user.ski.show', [
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
        $item = SKI::with(['user', 'laporan'])->where('id', $id)->findOrFail($id);
        return view('pages.user.ski.edit', [
            'item' => $item,
        ]);
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
        $data = SKI::findOrFail($id);
        $fileLama = $data->surat_rtrw;
        if ($request->surat_rtrw != null) {
            $data->surat_rtrw = $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }
        $item = Laporan::findOrFail($data->id_laporan);
        $item->nama_izin = $request->nama_izin;
        $item->save();

        $data->update([
            'perihal' => $request->perihal,
            'tujuan_surat' => $request->tujuan_surat,
            'nama_izin' => $request->nama_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'tempat_izin' => $request->tempat_izin,
            'waktu_izin' => $request->waktu_izin,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hiburan' => $request->hiburan,
            'surat_rtrw' => $data->surat_rtrw,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil diubah');
            return redirect()->route('ski-user.index')->with('success', 'Data berhasil diubah');
        } else {
            Alert::error('Gagal', 'Permohonan gagal diubah');
            return redirect()->route('ski-user.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = SKI::findOrFail($request->id);
        $item = Laporan::findOrFail($data->id_laporan);
        // if ($data->surat_rtrw != null) {
        //     Storage::disk('public')->delete($data->surat_rtrw);
        // }
        $data->delete();
        $item->delete();

        return response()->json($data);
    }
}
