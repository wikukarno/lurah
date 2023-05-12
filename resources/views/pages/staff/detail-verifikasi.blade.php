@extends('layouts.dashboard')

@section('title')
Detail Verifikasi Pengguna
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title d-lg-flex">
                            <h3 class="card-title">Detail Verifikasi pengguna</h3>
                            {{-- <span class="mt-1 ml-lg-3"><b>{{ $item->name }}</b></span> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.ubah-foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                @if ($users->foto != null)

                                <img src="{{ Storage::url($users->foto) }}"
                                    class="figure-img img-fluid rounded-circle thumbnail-image" alt="foto profile"
                                    id="foto-profile" />

                                @else

                                <img class="profile-user-img img-fluid img-circle thumbnail-image"
                                    src="{{ asset('assets/images/user.png') }}" alt="User profile picture" />
                                @endif
                            </div>
                        </form>
                        <h3 class="profile-username text-center">{{ $users->nama }}</h3>
                        <p class="text-center">{{ $users->roles }} Desa Sorek</p>

                        <section class="section-profile-content">
                            <form action="{{ route('akun-user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_profile" id="id_profile">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input type="number" class="form-control" id="nik" name="nik"
                                                value="{{ $users->nik ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $users->no_telepon ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" class="form-control"
                                                value="{{ $users->jenis_kelamin ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                name="tempat_lahir"
                                                value="{{ $users->tempat_lahir ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                value="{{ $users->tanggal_lahir ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                value="{{ $users->pekerjaan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                                value="{{ $users->kecamatan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                                value="{{ $users->kelurahan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="rtrw">RT/RW</label>
                                            <input type="text" class="form-control" id="rtrw" name="rtrw"
                                                value="{{ $users->rtrw ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama"
                                                value="{{ $users->agama ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <input type="text" class="form-control" id="status_perkawinan"
                                                name="status_perkawinan"
                                                value="{{ $users->status_perkawinan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control"
                                                value="{{ $users->alamat ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <figure class="figure">
                                            <img src="{{ Storage::url($users->ktp ?? '') }}"
                                                class="figure-img w-100 img-fluid rounded" alt="KTP">
                                        </figure>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <figure class="figure">
                                            <img src="{{ Storage::url($users->kk ?? '') }}"
                                                class="figure-img w-100 img-fluid rounded" alt="KK">
                                        </figure>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <a href="{{ route('staff.verifikasi-penduduk') }}"
                                            class="btn btn-danger btn-block mb-3">kembali</a>
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

@push('after-scripts')
@endpush

@push('after-styles')
<style>
    .thumbnail-image {
        max-height: 100px;
        background-size: cover
    }
</style>