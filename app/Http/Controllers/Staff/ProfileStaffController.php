<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->first();
        return view('pages.staff.profile', compact('users'));
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
            $where = array('users.id' => $request->id);
            $result = User::where($where)->first();
            if ($result) {
                return Response()->json($result);
            } else {
                return Response()->json(['error' => 'Akun tidak ditemukan!']);
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
        $users = User::findOrFail($id);
        return view('pages.staff.update-profile', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->nik = $request->nik;
        $user->no_telepon = $request->no_telepon;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->pekerjaan = $request->pekerjaan;
        $user->kecamatan = $request->kecamatan;
        $user->kelurahan = $request->kelurahan;
        $user->rtrw = $request->rtrw;
        $user->agama = $request->agama;
        $user->status_perkawinan = $request->status_perkawinan;
        $user->alamat = $request->alamat;

        $fileLama = $user->foto;
        $fileLamaKtp = $user->ktp;
        $fileLamaKk = $user->kk;

        if ($request->foto != null) {
            $user->foto = $request->file('foto')->storeAs('assets/foto', '' . Auth::user()->nama . '_' 
            . $request->file('foto')->getClientOriginalName(),
            'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }

        if ($request->ktp != null) {
            $user->ktp = $request->file('ktp')->storeAs('assets/ktp',
                '' . Auth::user()->nama . '_'
                . $request->file('foto')->getClientOriginalName(),
                'public'
            );
            if ($fileLamaKtp != null) {
                Storage::disk('public')->delete($fileLamaKtp);
            }
        }

        if ($request->kk != null) {
            $user->kk = $request->file('kk')->storeAs('assets/kk',
                '' . Auth::user()->nama . '_'
                . $request->file('foto')->getClientOriginalName(),
                'public'
            );
            if ($fileLamaKk != null) {
                Storage::disk('public')->delete($fileLamaKk);
            }
        }

        $user->save();

        if ($user) {
            Alert::success('Berhasil', 'Data Berhasil Diubah');
            return redirect()->route('akun-staff.index')->with('success', 'Data berhasil diubah!');
        } else {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return redirect()->route('akun-staff.index')->with('error', 'Data gagal diubah!');
        }
    }

    public function ubahFoto(Request $request)
    {
        $user = User::find($request->id);
        $user->foto = $request->file('foto')->store('assets/profile', 'public');
        $user->save();

        // Alert::success('Berhasil', 'Foto Profile Berhasil Diubah');
        return redirect()->back();
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
