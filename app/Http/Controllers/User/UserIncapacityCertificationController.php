<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IncapacityCertifications;
use App\Models\Letter;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIncapacityCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = IncapacityCertifications::with(['letter', 'userDetails'])->where('users_id', Auth::user()->id)->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('name', function ($item) {
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
        return view('pages.user.sktm.index', compact('userDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.sktm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = IncapacityCertifications::create([
            'users_id' => Auth::user()->id,
            'letters_id' => 4,
            'tujuan' => $request->tujuan,
            'surat_rtrw' => $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public'),
            'posisi' => 'staff',
            'status' => 'Belum Diproses',
        ]);

        if ($data) {
            return redirect()->route('sktm-user.index')->with('success', 'Surat Keterangan Tidak Mampu Berhasil Dibuat');
        } else {
            return redirect()->route('sktm-user.index')->with('error', 'Surat Keterangan Tidak Mampu Gagal Dibuat');
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
