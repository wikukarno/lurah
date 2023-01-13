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
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-center">{{ Auth::user()->roles }} Desa Sorek</p>

                        <section class="section-profile-content">
                            <form action="{{ route('akun-user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_profile" id="id_profile">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input type="number" class="form-control" id="nik" name="nik" value="{{ $users->userDetails->nik }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $users->userDetails->phone }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                required>
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
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                name="tempat_lahir" value="{{ $users->userDetails->tempat_lahir }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir" value="{{ $users->userDetails->tanggal_lahir }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                value="{{ $users->userDetails->pekerjaan }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                                value="{{ $users->userDetails->kecamatan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                                value="{{ $users->userDetails->kelurahan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="rtrw">RT/RW</label>
                                            <input type="text" class="form-control" id="rtrw" name="rtrw" value="{{ $users->userDetails->rtrw }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama" required>
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
                                            <select class="form-control" id="status_perkawinan" name="status_perkawinan"
                                                required>
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
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="ktp">Upload KTP</label>
                                            <input type="file" class="form-control" id="ktp" name="ktp" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kk">Upload KK</label>
                                            <input type="file" class="form-control" id="kk" name="kk" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kk">Upload Foto Profile</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" required>
                                                {{ $users->userDetails->address }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <a href="{{ route('akun-user.index') }}"
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