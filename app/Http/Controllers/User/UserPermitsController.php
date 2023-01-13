<?php

namespace App\Http\Controllers\User;

use App\Models\Letter;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permits;
use Illuminate\Support\Facades\Auth;

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
            $query = Permits::with(['letter', 'userDetails'])->where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->editColumn('nama', function ($item) {
                    return $item->userDetails->name;
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="#" class="badge badge-pill badge-danger" onclick="penolakan(' . $item->id . ')">' . $item->status . '</a>
                        ';
                    } else {
                        return '
                            <a href="#" class="badge badge-pill badge-success" onclick="selesaiProses(' . $item->id . ')">' . $item->status . '</a>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status'])
                ->make(true);
        }
        $userDetails = UserDetails::with('user')->where('users_id', Auth::user()->id)->get();
        return view('pages.user.ski.index', compact('userDetails'));
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
            'letters_id' => 2,
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

        if ($data) {
            return redirect()->route('ski-user.index')->with('success', 'Data berhasil ditambahkan');
        } else {
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
        //
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
