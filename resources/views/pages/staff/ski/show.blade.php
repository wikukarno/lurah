@extends('layouts.dashboard')

@section('title')
Surat Keterangan Izin
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title d-lg-flex">
                            <h3 class="card-title">Detail Data Surat Keterangan Izin</h3>
                            <span class="mt-1 ml-lg-3"><b>{{ $item->user->name }}</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control"
                                        value="{{ $item->user->userDetails->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{ $item->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="nama">Nama Izin</label>
                                    <input type="text" class="form-control" value="{{ $item->nama_izin }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="">Nama Perihal</label>
                                    <input type="text" class="form-control" value="{{ $item->perihal }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="">Tujuan Surat</label>
                                    <input type="text" class="form-control" value="{{ $item->tujuan_surat }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="">Tanggal Acara</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($item->tanggal_izin)->isoFormat('D MMMM Y') }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Acara</label>
                                    <input type="text" class="form-control" value="{{ $item->tempat_izin }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Jam</label>
                                    <input type="text" class="form-control" value="{{ $item->waktu_izin }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jumlah Peserta</label>
                                    <input type="text" class="form-control" value="{{ $item->jumlah_peserta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Hiburan</label>
                                    <input type="text" class="form-control" value="{{ $item->hiburan }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Kelurahan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->user->userDetails->kelurahan }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">RT / RW</label>
                                    <input type="text" class="form-control" value="{{ $item->user->userDetails->rtrw }}"
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
                                <a href="{{ route('ski-staff.index') }}" class="btn btn-danger btn-block">Kembali</a>
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