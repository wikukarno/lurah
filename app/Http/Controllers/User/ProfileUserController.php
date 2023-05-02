<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDetailRequest;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->first();
        return view('pages.user.profile', compact('users'));
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
        $data = User::Create(
            [
                'nik' => $request->nik,
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'rtrw' => $request->rtrw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('assets/foto', 'public'),
                'ktp' => $request->file('ktp')->store('assets/ktp', 'public'),
                'kk' => $request->file('kk')->store('assets/kk', 'public'),
            ]
        );

        $user = User::find(Auth::user()->id_user_user);
        $user->status_account = 'pending';
        $user->save();

        if ($data) {
            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->route('akun-user.index')->with('success', 'Data berhasil disimpan!');
        } else {
            Alert::error('Gagal', 'Data Gagal Disimpan');
            return redirect()->route('akun-user.index')->with('error', 'Data gagal disimpan!');
        }
    }

    public function completeProfile(Request $request)
    {
        $item = User::find(Auth::user()->id_user_user);
        return view('pages.user.complete-profile', compact('item'));
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
            $where = array('users.id_user' => $request->id_user);
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
        return view('pages.user.update-profile', compact('users'));
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
        $user = User::findOrFail(Auth::user()->id);
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
        if($user->status_account == "none"){
            $user->status_account = "pending";
        }

        $fileLama = $user->foto;
        $fileLamaKtp = $user->ktp;
        $fileLamaKk = $user->kk;

        if ($request->foto != null) {
            $user->foto = $request->file('foto')->store('assets/foto', 'public');
            if ($fileLama != null) {
                Storage::disk('public')->delete($fileLama);
            }
        }

        if ($request->ktp != null) {
            $user->ktp = $request->file('ktp')->store('assets/ktp', 'public');
            if ($fileLamaKtp != null) {
                Storage::disk('public')->delete($fileLamaKtp);
            }
        }

        if ($request->kk != null) {
            $user->kk = $request->file('kk')->store('assets/kk', 'public');
            if ($fileLamaKk != null) {
                Storage::disk('public')->delete($fileLamaKk);
            }
        }

        $user->save();

        if ($user) {
            Alert::success('Berhasil', 'Data Berhasil Diubah');
            return redirect()->route('akun-user.index')->with('success', 'Data berhasil diubah!');
        } else {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return redirect()->route('akun-user.index')->with('error', 'Data gagal diubah!');
        }
    }

    public function ubahFoto(Request $request)
    {
        $user = User::find($request->id_user);
        $user->foto = $request->file('foto')->store('assets/profile', 'public');
        $user->save();

        if ($user) {
            Alert::success('Berhasil', 'Foto Berhasil Diubah');
            return redirect()->route('akun-user.index')->with('success', 'Foto berhasil diubah!');
        } else {
            Alert::error('Gagal', 'Foto Gagal Diubah');
            return redirect()->route('akun-user.index')->with('error', 'Foto gagal diubah!');
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

    public function cekNik(Request $request)
    {
       return UserDetails::where('nik', $request->nik)->count() > 0 ? 'false' : 'true';
    }


    public function storeCompleteProfile(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id_user);
    }
}
