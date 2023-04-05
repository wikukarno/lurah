@extends('layouts.dashboard')

@section('title')
Update Surat Izin
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Surat Izin Keramaian</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ski-user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Acara</label>
                                        <input type="text" class="form-control" id="nama_izin" name="nama_izin" maxlength="30" value="{{ $item->nama_izin }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" class="form-control" maxlength="30" id="perihal"
                                            name="perihal" value="{{ $item->perihal }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tujuan_surat">Tujuan Surat</label>
                                        <input type="text" class="form-control" id="tujuan_surat" maxlength="30" name="tujuan_surat" value="{{ $item->tujuan_surat }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                        <input type="date" class="form-control" id="tanggal_izin" name="tanggal_izin" value="{{ $item->tanggal_izin }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
                                        <input type="time" class="form-control" id="waktu_izin" maxlength="7" name="waktu_izin" value="{{ $item->waktu_izin }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="tempat_izin">Tempat Pelaksanaan</label>
                                        <input type="text" class="form-control" id="tempat_izin" maxlength="30" name="tempat_izin" value="{{ $item->tempat_izin }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="jumlah_undangan">Jumlah Undangan</label>
                                        <input type="number" class="form-control" id="jumlah_peserta" maxlength="5"
                                            name="jumlah_peserta" value="{{ $item->jumlah_peserta }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="hiburan">Nama Hiburan</label>
                                        <input type="text" class="form-control" id="hiburan" name="hiburan" maxlength="20" value="{{ $item->hiburan }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW</label>
                                        <input type="file" class="form-control" id="surat_rtrw" name="surat_rtrw">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KTP Asli</label>
                                        <img src="{{ Storage::url(Auth::user()->userDetails->ktp) }}" class="img-fluid"
                                            alt="ktp">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KK Asli</label>
                                        <img src="{{ Storage::url(Auth::user()->userDetails->kk) }}" class="img-fluid"
                                            alt="kk">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-12 col-lg-6">
                                    <a href="{{ route('ski-user.index') }}" type="button"
                                        class="btn btn-danger btn-block">Batal</a>
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