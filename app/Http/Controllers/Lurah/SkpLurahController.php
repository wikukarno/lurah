<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class SkpLurahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Letter::where('jenis_surat', 'SKP')->where('posisi', 'lurah')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-secondary" onclick="lampiranSkpLurah(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="' . route('skp-lurah.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '        
                            ' . csrf_field() . '
                                <button class="btn btn-sm btn-success">
                                    Setujui
                                </button>
                            </form>
                        ';
                    } elseif ($item->status == 'Selesai') {
                        return '
                            <a href="#" class="btn btn-sm btn-outline-success">
                                Cetak
                            </a>
                        ';
                    } else {
                        return '
                            <a href="#" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('skp-lurah.update', $item->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <button class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        return view('pages.lurah.skp.index');
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
    public function show(Request $request)
    {
        if (request()->ajax()) {
            $where = array('letters.id' => $request->id);
            $result = Letter::where($where)->first();
            if ($result) {
                return Response()->json($result);
            } else {
                return Response()->json(['error' => 'Lampiran tidak ditemukan!']);
            }
        } else {
            $result = (['status' => false, 'message' => 'Maaf, akses ditolak!']);
        }
        return Response()->json($result);
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
        $skp = Letter::findOrFail($id);
        $skp->status = 'Selesai Diproses';
        $skp->posisi = 'Staff';
        $skp->save();

        if ($skp) {
            // Alert::success('Berhasil', 'Surat Keterangan Usaha berhasil disetujui!');
            return redirect()->route('skp-lurah.index');
        } else {
            // Alert::error('Gagal', 'Surat Keterangan Usaha gagal disetujui!');
            return redirect()->route('skp-lurah.index');
        }

        return redirect()->route('skp-lurah.index');
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
