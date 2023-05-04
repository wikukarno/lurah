@extends('layouts.dashboard')

@section('title', 'Update Profile')

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Profile Profile</h3>
                    </div>
                    <div class="card-body">
                        <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>
                        <p class="text-center">{{ Auth::user()->roles }} Desa Sorek</p>

                        <section class="section-profile-content">
                            <form action="{{ route('akun-lurah.update', $users->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_profile" id="id_profile">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input type="number" class="form-control" id="nik" name="nik" maxlength="16"
                                                value="{{ $users->nik }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="no_telepon">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" maxlength="12"
                                                value="{{ $users->no_telepon }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="Laki-laki" @if (Auth::user()->jenis_kelamin ==
                                                    'Laki-laki')
                                                    selected
                                                    @endif>Laki-laki</option>
                                                <option value="Perempuan" @if (Auth::user()->jenis_kelamin ==
                                                    'Perempuan')
                                                    selected
                                                    @endif>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" maxlength="30"
                                                name="tempat_lahir" value="{{ $users->tempat_lahir }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir" value="{{ $users->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" maxlength="30"
                                                value="{{ $users->pekerjaan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" maxlength="20"
                                                value="{{ $users->kecamatan }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" maxlength="15"
                                                value="{{ $users->kelurahan }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="rtrw">RT/RW</label>
                                            <input type="text" class="form-control" id="rtrw" name="rtrw" maxlength="10"
                                                value="{{ $users->rtrw }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama">
                                                <option value="Islam" @if (Auth::user()->agama == 'Islam') selected
                                                    @endif>Islam</option>
                                                <option value="Kristen" @if (Auth::user()->agama == 'Kristen') selected
                                                    @endif>Kristen</option>
                                                <option value="Katholik" @if (Auth::user()->agama == 'Katholik')
                                                    selected
                                                    @endif>Katholik</option>
                                                <option value="Hindu" @if (Auth::user()->agama == 'Hindu') selected
                                                    @endif>Hindu</option>
                                                <option value="Budha" @if (Auth::user()->agama == 'Budha') selected
                                                    @endif>Budha</option>
                                                <option value="Konghucu" @if (Auth::user()->agama == 'Konghucu')
                                                    selected
                                                    @endif>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <select class="form-control" id="status_perkawinan"
                                                name="status_perkawinan">
                                                <option value="Belum Kawin" @if (Auth::user()->status_perkawinan ==
                                                    'Belum
                                                    Kawin')
                                                    selected
                                                    @endif>Belum Kawin</option>
                                                <option value="Kawin" @if (Auth::user()->status_perkawinan == 'Kawin')
                                                    selected
                                                    @endif>Kawin</option>
                                                <option value="Cerai Hidup" @if (Auth::user()->status_perkawinan ==
                                                    'Cerai
                                                    Hidup')
                                                    selected
                                                    @endif>Cerai Hidup</option>
                                                <option value="Cerai Mati" @if (Auth::user()->status_perkawinan ==
                                                    'Cerai
                                                    Mati')
                                                    selected
                                                    @endif>Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="kk">Upload Foto Profile</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" maxlength="50"
                                                value="{{ $users->alamat }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <a href="{{ route('akun-lurah.index') }}"
                                            class="btn btn-danger btn-block mb-3">Batal</a>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection