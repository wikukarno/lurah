@extends('layouts.dashboard')

@section('title')
Update Surat Keterangan Pemakaman
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Surat Keterangan Pemakaman</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('skp-user.update', $item->id_surat_keterangan_pemakaman) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik" maxlength="16"
                                            value="{{ $item->nik }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Alm/Almh</label>
                                        <input type="text" class="form-control" id="nama" name="nama" maxlength="30"
                                            value="{{ $item->nama }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" maxlength="30"
                                            value="{{ $item->tempat_lahir }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ $item->tanggal_lahir }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_meninggal">Tanggal Meninggal</label>
                                        <input type="date" class="form-control" id="tanggal_meninggal"
                                            name="tanggal_meninggal" value="{{ $item->tanggal_meninggal }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_dimakamkan">Tanggal Dimakamkan</label>
                                        <input type="date" class="form-control" id="tanggal_dimakamkan"
                                            name="tanggal_dimakamkan" value="{{ $item->tanggal_dimakamkan }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama_pemakaman">Nama Tempat Pemakaman</label>
                                        <input type="text" class="form-control" id="tempat_pemakaman" maxlength="30"
                                            name="tempat_pemakaman" value="{{ $item->tempat_pemakaman }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                            <option value="">Pilih jenis kelamin</option>
                                            <option value="Laki-laki" {{ $item->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Laki-laki</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" maxlength="30"
                                            value="{{ $item->pekerjaan }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ $item->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ $item->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ $item->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ $item->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Budha" {{ $item->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                            <option value="Konghucu" {{ $item->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" maxlength="20"
                                            value="{{ $item->kecamatan }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" maxlength="15"
                                            value="{{ $item->kelurahan }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW</label>
                                        <input type="file" class="form-control" id="surat_rtrw" name="surat_rtrw">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">RT / RW</label>
                                        <input type="text" class="form-control" id="rtrw" name="rtrw" maxlength="10"
                                            value="{{ $item->rtrw }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" maxlength="50"
                                            value="{{ $item->alamat }}">
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
                                <div class="col-6">
                                    <a href="{{ route('skp-user.index') }}" class="btn btn-danger btn-block">Batal</a>
                                </div>
                                <div class="col-6">
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