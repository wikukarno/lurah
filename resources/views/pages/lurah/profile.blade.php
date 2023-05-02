@extends('layouts.dashboard')

@section('title')
Profile {{ Auth::user()->nama }}
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Akun Saya</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.ubah-foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                @if (Auth::user()->foto != null)

                                <img src="{{ Storage::url(Auth::user()->foto) }}"
                                    class="figure-img img-fluid rounded-circle thumbnail-image" alt="foto profile"
                                    id="foto-profile" />

                                @else

                                <img class="profile-user-img img-fluid img-circle thumbnail-image"
                                    src="{{ asset('assets/images/user.png') }}" alt="User profile picture" />
                                @endif
                            </div>
                        </form>
                        <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>
                        <p class="text-center">{{ Auth::user()->roles }} Desa Sorek</p>

                        <section class="section-profile-content">
                            <form action="{{ route('akun-staff.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_profile" id="id_profile">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input type="number" class="form-control" id="nik" name="nik"
                                                value="{{ $users->userDetails->nik ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $users->userDetails->phone ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" class="form-control"
                                                value="{{ $users->userDetails->jenis_kelamin ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                name="tempat_lahir"
                                                value="{{ $users->userDetails->tempat_lahir ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir"
                                                value="{{ $users->userDetails->tanggal_lahir ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                value="{{ $users->userDetails->pekerjaan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                                value="{{ $users->userDetails->kecamatan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                                value="{{ $users->userDetails->kelurahan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="rtrw">RT/RW</label>
                                            <input type="text" class="form-control" id="rtrw" name="rtrw"
                                                value="{{ $users->userDetails->rtrw ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama"
                                                value="{{ $users->userDetails->agama ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <input type="text" class="form-control" id="status_perkawinan"
                                                name="status_perkawinan"
                                                value="{{ $users->userDetails->status_perkawinan ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control"
                                                value="{{ $users->userDetails->address ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <a href="{{ route('lurah.dashboard') }}"
                                            class="btn btn-danger btn-block mb-3">Batal</a>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <a href="{{ route('akun-lurah.edit', $users->id) }}"
                                            class="btn btn-primary btn-block mb-3">Perbarui Akun</a>
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
<script>
    function updateImage() {
        document.getElementById('update-image-user').click();
    }
    function addImage() {
        document.getElementById('add-image-user').click();
    }
</script>
@endpush

@push('after-styles')
<style>
    .thumbnail-image {
        max-height: 100px;
        background-size: cover
    }
</style>
@endpush