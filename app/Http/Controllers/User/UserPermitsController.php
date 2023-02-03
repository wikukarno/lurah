<?php

namespace App\Http\Controllers\User;

use App\Models\Letter;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permits;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserPermitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Permits::with(['letter', 'user.userDetails'])->where('users_id', Auth::user()->id)->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('ski-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        $userDetails = UserDetails::with('user')->where('users_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.user.ski.index', compact('userDetails', 'user'));
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = Permits::with([
                'user.userDetails',
                'letter',
            ])->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses')->get();

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
            $query = Permits::with([
                'user.userDetails',
                'letter',
            ])->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses')->get();

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

                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="selesaiProses(' . $item->id . ')">
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
            $query = Permits::with([
                'user.userDetails',
                'letter',
            ])->where('users_id', Auth::user()->id)->where('status', 'Ditolak')->get();

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
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="penolakan(' . $item->id . ')">
                                Ditolak
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
        $data = Permits::create([
            'users_id' => Auth::user()->id,
            'letters_id' => 4,
            'perihal' => $request->perihal,
            'tujuan_surat' => $request->tujuan_surat,
            'nama_izin' => $request->nama_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'tempat_izin' => $request->tempat_izin,
            'waktu_izin' => $request->waktu_izin,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hiburan' => $request->hiburan,
            'surat_rtrw' => $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public'),
            'posisi' => 'staff',
            'status' => 'Belum Diproses',
        ]);

        $item = new Letter();
        $item->users_id = Auth::user()->id;
        $item->jenis_surat = 'Surat Keterangan Tidak Mampu';
        $item->save();

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
        $item = Permits::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);

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
        //
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
}
