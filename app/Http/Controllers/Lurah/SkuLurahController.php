<?php

namespace App\Http\Controllers\Lurah;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class SkuLurahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Letter::where('jenis_surat', 'SKU')->where('posisi', 'lurah')->get();

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
                    } else {
                        return '
                            <span class="badge badge-pill badge-success">' . $item->status . '</span>
                        ';
                    }
                })
                ->editColumn('action', function ($item) {
                    if ($item->posisi == 'lurah') {
                        return '
                            <a href="#" class="btn btn-sm btn-secondary" onclick="lampiranSkuLurah(' . $item->id . ')">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="' . route('sku-lurah.update', $item->id) . '" method="POST" class="d-inline">
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

                            <form action="' . route('sku-lurah.update', $item->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <button class="btn btn-sm btn-warning">
                                    Teruskan
                                </button>
                            </form>
                        ';
                    }
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.lurah.sku.index');
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
        $sku = Letter::findOrFail($id);
        $sku->status = 'Selesai Diproses';
        $sku->posisi = 'Staff';
        $sku->save();

        if ($sku) {
            // Alert::success('Berhasil', 'Surat Keterangan Usaha berhasil disetujui!');
            return redirect()->route('sku-lurah.index');
        } else {
            // Alert::error('Gagal', 'Surat Keterangan Usaha gagal disetujui!');
            return redirect()->route('sku-lurah.index');
        }

        return redirect()->route('sku-lurah.index');
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
