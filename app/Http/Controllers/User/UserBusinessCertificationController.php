<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessCertificationRequest;
use App\Models\BusinessCertifications;
use App\Models\Letter;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserBusinessCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            // $query = Letter::with('user')->where('users_id', Auth::user()->id)->where('categories_id', 1)->where('status', 'Belum Diproses')->get();
            $query = BusinessCertifications::with('user')->where('users_id', Auth::user()->id)->where('status', 'Belum Diproses')->get();
            return datatables()->of($query)
                ->addIndexColumn()
                // ->editColumn('users_id', function ($item) {
                //     return $item->user->name;
                // })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('surat_rtrw', function ($item) {
                    return '
                        <a href="' . asset('storage/' . $item->surat_rtrw) . '" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    ';
                })

                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="' . route('sku-user.edit', $item->id) . '" class="btn btn-sm btn-info">
                            <i class="fa fa-pencil-alt"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteData('. $item->id .')">
                            <i class="fa fa-trash"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'surat_rtrw', 'action', 'nama_usaha'])
                ->make(true);
        }
        $userDetails = UserDetails::with('user')->where('users_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.user.sku.index', compact('userDetails', 'user'));
    }
    public function onProgress()
    {
        if (request()->ajax()) {
            // $query = Letter::where('users_id', Auth::user()->id)->where('categories_id', 1)->where('status', 'Sedang Diproses')->get();
            $query = BusinessCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Sedang Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
        return view('pages.user.sku.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            // $query = Letter::where('users_id', Auth::user()->id)->where('categories_id', 1)->where('status', 'Selesai Diproses')->get();
            $query = BusinessCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Selesai Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
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
        return view('pages.user.sku.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            // $query = Letter::where('users_id', Auth::user()->id)->where('categories_id', 1)->where('status', 'Ditolak')->get();
            $query = BusinessCertifications::with('user.userDetails')->where('users_id', Auth::user()->id)->where('status', 'Ditolak')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'Belum Diproses') {
                        return '<span class="badge badge-pill badge-warning">' . $item->status . '</span>';
                    } elseif ($item->status == 'Sedang Diproses') {
                        return '<span class="badge badge-pill badge-info">' . $item->status . '</span>';
                    } elseif ($item->status == 'Ditolak') {
                        return '<span class="badge badge-pill badge-danger">' . $item->status . '</span>';
                    } else {
                        return '<span class="badge badge-pill badge-success">' . $item->status . '</span>';
                    }
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="form-group">
                            <a href="' . route('sku-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
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
        return view('pages.user.sku.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.sku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessCertificationRequest $request)
    {
        $item = new Letter();
        $item->users_id = Auth::user()->id;
        $item->categories_id = 1;
        $item->status = 'Belum Diproses';
        $item->posisi = 'Staff';
        $item->nama_usaha = $request->nama_usaha;
        $item->save();

        $data = BusinessCertifications::create([
            'letters_id' => $item->id,
            'users_id' => Auth::user()->id,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status' => 'Belum Diproses',
            'posisi' => 'Staff',
            'surat_rtrw' => $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public'),
        ]);

        

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil dikirim');
            return redirect()->route('sku-user.index');
        } else {
            Alert::error('Gagal', 'Permohonan gagal dikirim');
            return redirect()->route('sku-user.index')->with('error', 'Permohonan gagal dikirim');
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
        $item = BusinessCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);

        return view('pages.user.sku.show', [
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
        $item = BusinessCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);
        return view('pages.user.sku.edit', [
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
        $data = BusinessCertifications::findOrFail($id);
        $fileLama = $data->surat_rtrw;
        if ($request->surat_rtrw != null) {
            $data->surat_rtrw = $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }
        $item = Letter::findOrFail($data->letters_id);
        $item->nama_usaha = $request->nama_usaha;
        $item->save();

        $data->update([
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'surat_rtrw' => $data->surat_rtrw,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil diubah');
            return redirect()->route('sku-user.index');
        } else {
            Alert::error('Gagal', 'Permohonan gagal diubah');
            return redirect()->route('sku-user.index')->with('error', 'Permohonan gagal diubah');
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
        $data = BusinessCertifications::findOrFail($request->id);
        $item = Letter::findOrFail($data->letters_id);
        $data->delete();
        $item->delete();

        return response()->json($data);
    }

    public function showTolakSku(Request $request)
    {
        $data = BusinessCertifications::findOrFail($request->id);
        return response()->json($data);
    }
}
