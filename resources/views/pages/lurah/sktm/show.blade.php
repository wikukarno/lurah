@extends('layouts.dashboard')

@section('title')
Surat Keterangan Tidak Mampu
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title d-lg-flex">
                            <h3 class="card-title">Detail Data Surat Keterangan Tidak Mampu</h3>
                            <span class="mt-1 ml-lg-3"><b>{{ $item->user->nama }}</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($item->alasan_penolakan != null)
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Alasan Penolakan :</strong> {{ $item->alasan_penolakan }}.
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control"
                                        value="{{ $item->user->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" value="{{ $item->user->nama }}" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Tujuan Surat</label>
                                    <input type="text" class="form-control" value="{{ $item->tujuan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->tempat_lahir }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($item->user->tanggal_lahir)->isoFormat('D MMMM Y') }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->jenis_kelamin }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Pekerjaan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->pekerjaan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Status Perkawinan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->status_perkawinan }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Agama</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->agama }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Kecamatan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->kecamatan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Kelurahan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->kelurahan }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">RT / RW</label>
                                    <input type="text" class="form-control" value="{{ $item->user->rtrw }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->alamat }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto KTP</label>
                                    <img src="{{ Storage::url($item->user->ktp) }}" alt="foto ktp"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto KK</label>
                                    <img src="{{ Storage::url($item->user->kk) }}" alt="foto kk"
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
                                <a href="{{ route('sktm-lurah.index') }}" class="btn btn-danger btn-block">Kembali</a>
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