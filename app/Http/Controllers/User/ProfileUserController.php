<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDetailRequest;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userDetails')->where('id', Auth::user()->id)->first();
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
        $data = UserDetails::Create(
            [
                'users_id' => Auth::user()->id,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'rtrw' => $request->rtrw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'address' => $request->address,
                'avatar' => $request->file('avatar')->storePubliclyAs('assets/avatar', $request->file('avatar')->getClientOriginalName(), 'public'),
                'ktp' => $request->file('ktp')->storePubliclyAs('assets/ktp', $request->file('ktp')->getClientOriginalName(), 'public'),
                'kk' => $request->file('kk')->storePubliclyAs('assets/kk', $request->file('kk')->getClientOriginalName(), 'public'),
            ]
        );

        $user = new User();
        $user->status_account = 'pending';
        $user->save();

        if($data){
            return redirect()->route('akun-user.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('akun-user.index')->with('error', 'Data gagal disimpan!');
        }
    }

    public function completeProfile(Request $request)
    {
        return view('pages.user.complete-profile');
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
        $users = User::with('userDetails')->findOrFail($id);
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
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
    }

    public function ubahFoto(Request $request)
    {
        $user = User::find($request->id);
        $user->avatar = $request->file('avatar')->store('assets/profile', 'public');
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
