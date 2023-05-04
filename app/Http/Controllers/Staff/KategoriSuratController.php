<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = KategoriSurat::all();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('updated_at', function($item){
                    return $item->updated_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                    <a href="' . route('kategori-surat.edit', $item->id) . '" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.staff.kategori-surat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.staff.kategori-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = $request->all();

        $data = KategoriSurat::create($item);

        if($data){
            Alert::success('Berhasil', 'Kategori Surat Berhasil Ditambahkan');
            return redirect()->route('kategori-surat.index');
        }else{
            Alert::error('Gagal', 'Kategori Surat Gagal Ditambahkan');
            return redirect()->route('kategori-surat.create');
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
        $item = KategoriSurat::findOrFail($id);

        return view('pages.staff.kategori-surat.edit', [
            'item' => $item
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
        $item = KategoriSurat::findOrFail($id);

        $item->update($data);

        if($item){
            Alert::success('Berhasil', 'Kategori Surat Berhasil Diubah');
            return redirect()->route('kategori-surat.index');
        }else{
            Alert::error('Gagal', 'Kategori Surat Gagal Diubah');
            return redirect()->route('kategori-surat.edit', $id);
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
        $data = KategoriSurat::findOrFail($request->id);

        $data->delete();

        // kirim response ke ajax
        return response()->json($data);
    }
}
