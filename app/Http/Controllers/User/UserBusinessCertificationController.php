<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessCertificationRequest;
use App\Models\BusinessCertifications;
use App\Models\Category;
use App\Models\KategoriSurat;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\SKU;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserBusinessCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSkuDashboard()
    {
        // Datatables untuk tampil semua data surat keterangan usaha
        if (request()->ajax()) {
            $query = SKU::with('user')->where('id_user', Auth::user()->id)->get();
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
                    if($item->status == 'Belum Diproses'){
                        return '
                            <div class="d-flex">
                                <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary mx-1">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="' . route('sku-user.edit', $item->id) . '" class="btn btn-sm btn-info mx-1">
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
                                                url: "' . route('sku-user.hapus') . '",
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
                                                    $("#tb_sku_user_belum_diproses").DataTable().ajax.reload();
                                                    $("#tb_sku_user_ditolak").DataTable().ajax.reload();
                                                    $("#tb_sku_user_sedang_diproses").DataTable().ajax.reload();
                                                    $("#tb_sku_user_selesai_diproses").DataTable().ajax.reload();
                                                }
                                            });
                                        }
                                    })
                                });
                            </script>
                            
                        ';
                    }elseif($item->status == 'Sedang Diproses'){
                        return '
                            <span class="badge badge-warning">Sedang Diproses</span>
                        ';
                    }elseif ($item->status == 'Selesai Diproses') {
                        return '
                            <a href="javascript:void(0)" class="badge badge-success" onclick="selesaiProses()">
                                Selesai Diproses
                            </a>
                        ';
                    }else{
                        return '
                            <a href="' . route('sku-user.show', $item->id) . '" class="badge badge-danger mx-1">Ditolak
                            </a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }

        return view('pages.user.sku.show-surat');
    }

    public function index()
    {
        // Datatables untuk tampil data yang belum diproses
        if (request()->ajax()) {
            $query = SKU::with('user')->where('id_user', Auth::user()->id)->where('status', 'Belum Diproses')->get();
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
                    return '
                        <div class="d-flex">
                            <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary mx-1">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('sku-user.edit', $item->id) . '" class="btn btn-sm btn-info mx-1">
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
                                            url: "' . route('sku-user.hapus') . '",
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
                                                $("#tb_sku_user_belum_diproses").DataTable().ajax.reload();
                                                $("#tb_sku_user_ditolak").DataTable().ajax.reload();
                                                $("#tb_sku_user_sedang_diproses").DataTable().ajax.reload();
                                                $("#tb_sku_user_selesai_diproses").DataTable().ajax.reload();
                                            }
                                        });
                                    }
                                })
                            });
                        </script>
                        
                    ';
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }

        $user = User::where('id', Auth::user()->id)->first();

        return view('pages.user.sku.index', compact('user'));
    }
    public function onProgress()
    {
        // Datatables untuk tampil data yang sedang diproses
        if (request()->ajax()) {
            $query = SKU::with('user')->where('id_user', Auth::user()->id)->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.sku.index');
    }
    public function success()
    {
        // Datatables untuk tampil data yang berhasil
        if (request()->ajax()) {
            $query = SKU::with('user')->where('id_user', Auth::user()->id)->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="selesaiProses()">
                                Selesai Diproses
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.sku.index');
    }
    public function rejected()
    {

        // Datatables untuk tampil data yang ditolak
        if (request()->ajax()) {
            $query = SKU::with('user')->where('id_user', Auth::user()->id)->where('status', 'Ditolak')->get();

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
                    return '
                        <div class="form-group">
                            <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.sku.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // arahkan ke halaman create surat keterangan usaha
        return view('pages.user.sku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessCertificationRequest $request)
    {
        $category = KategoriSurat::where('nama', 'Surat Keterangan Usaha')->first();
        $item = new Laporan();
        $item->id_user = Auth::user()->id;
        $item->id_kategori_surat = $category->id;
        $item->status = 'Belum Diproses';
        $item->posisi = 'Staff';
        $item->nama_usaha = $request->nama_usaha;
        $item->save();

        // buat surat baru sesuai laporan yang dibuat
        $data = SKU::create([
            'id_laporan' => $item->id,
            'id_user' => Auth::user()->id,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status' => 'Belum Diproses',
            'posisi' => 'Staff',
            'surat_rtrw' => $request->file('surat_rtrw')->store('assets/surat_rtrw', 'public'),
        ]);

        // tampilkan notifikasi berhasil atau gagal
        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil dikirim');
            return redirect()->route('sku-user.index');
        } else {
            Alert::error('Gagal', 'Permohonan gagal dikirim');
            return redirect()->route('sku-user.index')->with('error', 'Permohonan gagal dikirim');
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
        // tampilkan detail surat keterangan usaha sesuai id

        $item = SKU::with('user', 'laporan')->where('id', $id)->findOrFail($id);
        return view('pages.user.sku.show', [
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
        // edit surat keterangan usaha
        $item = SKU::with(['user', 'laporan'])->where('id', $id)->findOrFail($id);
        return view('pages.user.sku.edit', [
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
        $data = $request->all();
        $sku = SKU::findOrFail($id);

        // cek ada kirim file surat_rtrw baru atau tidak kalau ada hapus file lama
        if($request->file('surat_rtrw')){
            $data['surat_rtrw'] = $request->file('surat_rtrw')->store('assets/surat_rtrw', 'public');
            if($sku->surat_rtrw && file_exists(storage_path('app/public/' . $sku->surat_rtrw))){
                Storage::delete('public/'. $sku->surat_rtrw);
            }
        }

        $sku->update($data);

        // update nama usaha di laporan
        $laporan = Laporan::findOrFail($sku->id_laporan);
        $laporan->nama_usaha = $request->nama_usaha;
        $laporan->save();

        // tampilkan notifikasi berhasil atau gagal
        if ($sku) {
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect()->route('sku-user.index');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect()->route('sku-user.index')->with('error', 'Data gagal diubah');
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
        // hapus pengajuan surat di tabel sku dan laporan
        $data = SKU::findOrFail($request->id);
        $item = Laporan::findOrFail($data->id_laporan);
        $data->delete();
        $item->delete();

        // kirim response ke ajax
        return response()->json($data);
    }

}
