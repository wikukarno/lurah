<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class SktmStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Letter::where('jenis_surat', 'SKTM')->orderBy('created_at', 'DESC');

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
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
                            <a href="' . route('sktm-staff.cetak-sktm', $item->id) . '" class="btn btn-sm btn-success" target="_blank">
                                Cetak
                            </a>
                        ';
                    } elseif ($item->status == 'Ditolak') {
                        return '
                            <a href="javascript:void(0)" class="btn btn-danger disabled">' . $item->status . '</a>
                        ';
                    } elseif ($item->status == 'Belum Diproses') {
                        return '
                            <a href="#" class="btn btn-sm btn-secondary" onclick="lampiranSktm(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="' . route('sktm-staff.update', $item->id) . '" method="POST" class="d-inline">
                            ' . method_field('PUT') . '    
                            ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>

                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="tolakSKTM(' . $item->id . ')">
                                Tolak
                            </a>

                        ';
                    }
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        return view('pages.staff.sktm.index');
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
        $sktm = Letter::findOrFail($id);
        $sktm->status = 'Sedang Diproses';
        $sktm->posisi = 'lurah';
        $sktm->save();

        if ($sktm) {
            // Alert::success('Berhasil', 'Surat Keterangan Usaha berhasil diteruskan!');
            return redirect()->route('sktm-staff.index');
        } else {
            // Alert::error('Gagal', 'sktm gagal diteruskan!');
            return redirect()->route('sktm-staff.index');
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

    public function tolakSktm(Request $request)
    {
        $sktm = Letter::findOrFail($request->id);
        $sktm->status = 'Ditolak';
        $sktm->posisi = 'staff';
        $sktm->alasan_penolakan = $request->alasan_penolakan;
        $sktm->save();

        if ($sktm) {
            return redirect()->route('sktm-staff.index');
        } else {
            return redirect()->route('sktm-staff.index');
        }
    }
}
