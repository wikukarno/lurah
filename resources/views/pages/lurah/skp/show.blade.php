@extends('layouts.dashboard')

@section('title')
Surat Keterangan Pemakaman
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title d-lg-flex">
                            <h3 class="card-title">Detail Data Surat Keterangan Pemakaman</h3>
                            <span class="mt-1 ml-lg-3"><b>{{ $item->user->name }}</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" value="{{ $item->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Nama Almarhum / Almarhumah</label>
                                    <input type="text" class="form-control" value="{{ $item->nama }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Tanggal Meninggal</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($item->tanggal_meninggal)->isoFormat('D MMMM Y') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Tempat Pemakaman</label>
                                    <input type="text" class="form-control" value="{{ $item->tempat_pemakaman }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="">Tanggal Dimakamkan</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($item->tanggal_dimakamkan)->isoFormat('D MMMM Y') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->tempat_lahir }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('D MMMM Y') }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->jenis_kelamin }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Pekerjaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->pekerjaan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Status Perkawinan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->userDetails->status_perkawinan }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Agama</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->agama }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Kecamatan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->kecamatan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Kelurahan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->kelurahan }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">RT / RW</label>
                                    <input type="text" class="form-control" value="{{ $item->rtrw }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->userDetails->address }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto KTP</label>
                                    <img src="{{ Storage::url($item->user->userDetails->ktp) }}" alt="foto ktp"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto KK</label>
                                    <img src="{{ Storage::url($item->user->userDetails->kk) }}" alt="foto kk"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto Surat RT/RW</label>
                                    <img src="{{ Storage::url($item->surat_rtrw) }}" alt="foto surat_rtrw"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 col-lg-12">
                                <a href="{{ route('skp-lurah.index') }}" class="btn btn-danger btn-block">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
@endpush