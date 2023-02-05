<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IncapacityCertifications;
use App\Models\Letter;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
            $query = IncapacityCertifications::with(['letter', 'user.userDetails'])->where('users_id', Auth::user()->id)->where('status', 'Belum Diproses')->get();

            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->isoFormat('D MMMM Y');
                })
                ->editColumn('action', function ($item) {
                    return '
                        <a href="' . route('sktm-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="' . route('sktm-user.edit', $item->id) . '" class="btn btn-sm btn-info">
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
        return view('pages.user.sktm.index', compact('userDetails', 'user'));
    }

    public function onProgress()
    {
        if (request()->ajax()) {
            $query = IncapacityCertifications::with([
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
                        <a href="' . route('sktm-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        return view('pages.user.sktm.index');
    }
    public function success()
    {
        if (request()->ajax()) {
            $query = IncapacityCertifications::with([
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
                            <a href="' . route('sktm-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
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
        return view('pages.user.sktm.index');
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $query = IncapacityCertifications::with([
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
                            <a href="' . route('sktm-user.show', $item->id) . '" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="penolakan(' . $item->id . ')">
                                Ditolak
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['created_at', 'action'])
                ->make(true);
        }
        return view('pages.user.sktm.index');
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
            'letters_id' => 3,
            'tujuan' => $request->tujuan,
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
            return redirect()->route('sktm-user.index')->with('success', 'Surat Keterangan Tidak Mampu Berhasil Dibuat');
        } else {
            Alert::error('Gagal', 'Permohonan gagal dikirim');
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
        $item = IncapacityCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);

        return view('pages.user.sktm.show', [
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
        $item = IncapacityCertifications::with(['user.userDetails', 'letter'])->where('id', $id)->findOrFail($id);
        return view('pages.user.sktm.edit', [
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
        $data = IncapacityCertifications::findOrFail($id);
        $fileLama = $data->surat_rtrw;
        if ($request->surat_rtrw != null) {
            $data->surat_rtrw = $request->file('surat_rtrw')->storePubliclyAs('assets/surat_rtrw', $request->file('surat_rtrw')->getClientOriginalName(), 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }
        $data->update([
            'tujuan' => $request->tujuan,
            'surat_rtrw' => $data->surat_rtrw,
        ]);

        if ($data) {
            Alert::success('Berhasil', 'Permohonan berhasil diubah');
            return redirect()->route('sktm-user.index')->with('success', 'Surat Keterangan Tidak Mampu Berhasil Diubah');
        } else {
            Alert::error('Gagal', 'Permohonan gagal diubah');
            return redirect()->route('sktm-user.index')->with('error', 'Surat Keterangan Tidak Mampu Gagal Diubah');
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
        $data = IncapacityCertifications::findOrFail($request->id);
        $item = Letter::findOrFail($data->letters_id);
        // if ($data->surat_rtrw != null) {
        //     Storage::disk('public')->delete($data->surat_rtrw);
        // }
        $data->delete();
        $item->delete();

        return response()->json($data);
    }
}
