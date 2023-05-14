@extends('layouts.dashboard')

@section('title')
Tambah Surat Keterangan Tidak Mampu
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Surat Keterangan Tidak Mampu</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sktm-user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik" maxlength="16"
                                            value="{{ Auth::user()->nik }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" maxlength="30"
                                            value="{{ Auth::user()->nama }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" maxlength="30"
                                            value="{{ Auth::user()->tempat_lahir }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ Auth::user()->tanggal_lahir }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Kelamin</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->jenis_kelamin }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" maxlength="30"
                                            value="{{ Auth::user()->pekerjaan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Agama</label>
                                        <input type="text" name="agama" id="agama" class="form-control"
                                            value="{{ Auth::user()->agama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Status Perkawinan</label>
                                        <input type="text" class="form-control" name="status_perkawinan"
                                            value="{{ Auth::user()->status_perkawinan }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            value="{{ Auth::user()->kecamatan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                            value="{{ Auth::user()->kelurahan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">RT / RW</label>
                                        <input type="text" class="form-control" id="rtrw" name="rtrw"
                                            value="{{ Auth::user()->rtrw }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="{{ Auth::user()->alamat }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tujuan_surat">Keperluan Surat</label>
                                        <input type="text" class="form-control" id="tujuan" name="tujuan" maxlength="30"
                                            placeholder="cth: Bantuan Baznas" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW</label>
                                        <input type="file" class="form-control" id="surat_rtrw" name="surat_rtrw"
                                            required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KTP Asli</label>
                                        <img src="{{ Storage::url(Auth::user()->ktp) }}" class="img-fluid"
                                            alt="ktp">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KK Asli</label>
                                        <img src="{{ Storage::url(Auth::user()->kk) }}" class="img-fluid"
                                            alt="kk">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-12 col-lg-6">
                                    <a href="{{ route('sktm-user.index') }}" class="btn btn-danger btn-block">Batal</a>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
@endpush