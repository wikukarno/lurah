<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FuneralCertifications;
use App\Models\KategoriSurat;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\SKP;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserFuneralCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id_user)->where('categories_id', 4)->where('status', 'Belum Diproses')->get();
            $query = SKP::with('user.userDetails')->where('id_user', Auth::user()->id_user)->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="d-flex">
                            <a href="' . route('skp-user.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary mx-1">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="' . route('skp-user.edit', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-info mx-1">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <form id="form-delete-letters" method="POST">
                                ' . csrf_field() . '
                                <input type="hidden" name="id_surat_keterangan_pemakaman" value="' . $item->id_surat_keterangan_pemakaman . '">
                                <button type="submit" id="btnDelete" class="btn btn-sm btn-danger mx-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </div> 

                        <script>
                            $("#form-delete-letters").submit(function (e) {
                                e.preventDefault();
                                var id = $("input[name=id_surat_keterangan_pemakaman]").val();

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
                                            url: "' . route('skp-user.hapus') . '",
                                            type: "POST",
                                            data: {
                                                id_surat_keterangan_pemakaman: id,
                                                _token: "' . csrf_token() . '"
                                            },
                                            success: function (data) {
                                                Swal.fire(
                                                    "Berhasil!",
                                                    "Surat berhasil dihapus",
                                                    "success"
                                                )
                                                $("#tb_skp_user_belum_diproses").DataTable().ajax.reload();
                                                $("#tb_skp_user_ditolak").DataTable().ajax.reload();
                                                $("#tb_skp_user_sedang_diproses").DataTable().ajax.reload();
                                                $("#tb_skp_user_selesai_diproses").DataTable().ajax.reload();
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
        $userDetails = UserDetails::with('user')->where('users_id', Auth::user()->id_user)->get();
        $user = User::where('id', Auth::user()->id_user)->first();
        return view('pages.user.skp.index', compact('userDetails', 'user'));
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id_user)->where('categories_id', 4)->where('status', 'Sedang Diproses')->get();
            $query = SKP::with('user.userDetails')->where('id_user', Auth::user()->id_user)->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })

                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('skp-user.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.skp.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id_user)->where('categories_id', 4)->where('status', 'Selesai Diproses')->get();
            $query = SKP::with('user.userDetails')->where('id_user', Auth::user()->id_user)->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('skp-user.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
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
        return view('pages.user.skp.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id_user)->where('categories_id', 4)->where('status', 'Ditolak')->get();
            $query = SKP::with('user.userDetails')->where('id_user', Auth::user()->id_user)->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('skp-user.show', $item->id_surat_keterangan_pemakaman) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.skp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.skp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = KategoriSurat::where('nama', 'Surat Keterangan Pemakaman')->first();
        $item = new Laporan();
        $item->id_user = Auth::user()->id_user;
        $item->id_kategori_surat = $category->id_kategori_surat;
        $item->status = 'Belum Diproses';
        $item->posisi = 'Staff';
        $item->nama = $request->nama;
        $item->save();

        $data = SKP::create([
            'id_user' => Auth::user()->id_user,
            'id_laporan' => $item->id_laporan,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'rtrw' => $request->rtrw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'agama' => $request->agama,
            'status' => 'Belum Diproses',
            'posisi' => 'Staff',
            'surat_rtrw' => $request->file('surat_rtrw')->store('assets/surat_rtrw', 'public'),
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'tempat_pemakaman'  => $request->tempat_pemakaman,
            'tanggal_dimakamkan' => $request->tanggal_dimakamkan,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil dikirim');
            return redirect()->route('skp-user.index')->with('success', 'Data berhasil disimpan');
        } else {
            Alert::error('Gagal', 'Permohonan gagal dikirim');
            return redirect()->route('skp-user.index')->with('error', 'Data gagal disimpan');
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
        $item = SKP::with(['user.userDetails', 'letter'])->where('id_user', Auth::user()->id_user)->findOrFail($id);
        // dd($item);

        return view('pages.user.skp.show', [
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
        $item = SKP::with(['user.userDetails', 'letter'])->where('id_user', Auth::user()->id_user)->findOrFail($id);
        return view('pages.user.skp.edit', [
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
        $data = SKP::findOrFail($id);
        $fileLama = $data->surat_rtrw;
        if ($request->surat_rtrw != null) {
            $data->surat_rtrw = $request->file('surat_rtrw')->store('assets/surat_rtrw', 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }

        $item = Laporan::findOrFail($data->id_laporan);
        $item->nama = $request->nama;
        $item->save();

        $data->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'rtrw' => $request->rtrw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'agama' => $request->agama,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'tempat_pemakaman' => $request->tempat_pemakaman,
            'tanggal_dimakamkan' => $request->tanggal_dimakamkan,
            'surat_rtrw' => $data->surat_rtrw,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil diubah');
            return redirect()->route('skp-user.index')->with('success', 'Data berhasil disimpan');
        } else {
            Alert::error('Gagal', 'Permohonan gagal diubah');
            return redirect()->route('skp-user.index')->with('error', 'Data gagal disimpan');
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
        $data = SKP::findOrFail($request->id_surat_keterangan_pemakaman);
        $item = Laporan::findOrFail($data->id_laporan);
        // if ($data->surat_rtrw != null) {
        //     Storage::disk('public')->delete($data->surat_rtrw);
        // }
        $data->delete();
        $item->delete();

        return response()->json($data);
    }
}
