<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FuneralCertifications;
use App\Models\Letter;
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
            // $query = Letter::with('user')->where('users_id', Auth::user()->id)->where('categories_id', 4)->where('status', 'Belum Diproses')->get();
            $query = FuneralCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('skp-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="' . route('skp-user.edit', $item->id) . '" class="btn btn-sm btn-info">
                            <i class="fa fa-pencil-alt"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteData(' . $item->id . ')">
                            <i class="fa fa-trash"></i>
                        </a>

                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        $userDetails = UserDetails::with('user')->where('users_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.user.skp.index', compact('userDetails', 'user'));
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id)->where('categories_id', 4)->where('status', 'Sedang Diproses')->get();
            $query = FuneralCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })

                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('skp-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
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
            // $query = Letter::with('user')->where('users_id', Auth::user()->id)->where('categories_id', 4)->where('status', 'Selesai Diproses')->get();
            $query = FuneralCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('skp-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="selesaiProses(' . $item->id . ')">
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
            // $query = Letter::with('user')->where('users_id', Auth::user()->id)->where('categories_id', 4)->where('status', 'Ditolak')->get();
            $query = FuneralCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('skp-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="penolakan(' . $item->id . ')">
                                Ditolak
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
        // dd($request->all());
        $item = new Letter();
        $item->users_id = Auth::user()->id;
        $item->categories_id = 'bf088ce2-753c-4c40-9a06-c078b75bc418';
        $item->status = 'Belum Diproses';
        $item->posisi = 'Staff';
        $item->nama = $request->nama;
        $item->save();

        $data = FuneralCertifications::create([
            'users_id' => Auth::user()->id,
            'letters_id' => $item->id,
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
            'surat_rtrw' => $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public'),
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
        $item = FuneralCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);

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
        $item = FuneralCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);
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
        $data = FuneralCertifications::findOrFail($id);
        $fileLama = $data->surat_rtrw;
        if ($request->surat_rtrw != null) {
            $data->surat_rtrw = $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }

        $item = Letter::findOrFail($data->letters_id);
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
        $data = FuneralCertifications::findOrFail($request->id);
        $item = Letter::findOrFail($data->letters_id);
        // if ($data->surat_rtrw != null) {
        //     Storage::disk('public')->delete($data->surat_rtrw);
        // }
        $data->delete();
        $item->delete();

        return response()->json($data);
    }
}
