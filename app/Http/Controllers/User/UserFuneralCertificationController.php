<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FuneralCertifications;
use App\Models\Letter;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $query = FuneralCertifications::with(['letter', 'userDetails'])->where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
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
        return view('pages.user.skp.index', compact('userDetails'));
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
        $data = FuneralCertifications::create([
            'users_id' => Auth::user()->id,
            'letters_id' => 3,
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
            'surat_rtrw' => $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public'),
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'tempat_pemakaman'  => $request->tempat_pemakaman,
            'tanggal_dimakamkan' => $request->tanggal_dimakamkan,
        ]);

        if ($data) {
            return redirect()->route('skp-user.index')->with('success', 'Data berhasil disimpan');
        } else {
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
