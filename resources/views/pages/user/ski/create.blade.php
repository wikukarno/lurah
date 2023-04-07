@extends('layouts.dashboard')

@section('title')
Tambah Surat Izin
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Surat Izin Keramaian</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ski-user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik"
                                            value="{{ Auth::user()->userDetails->nik }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ Auth::user()->userDetails->tempat_lahir }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ Auth::user()->userDetails->tanggal_lahir }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            value="{{ Auth::user()->userDetails->pekerjaan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="{{ Auth::user()->userDetails->address }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Nama Acara</label>
                                        <input type="text" class="form-control" id="nama_izin" name="nama_izin" maxlength="30"
                                            placeholder="Masukkan nama acara" required
                                            oninvalid="this.setCustomValidity('Masukan nama izin')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" class="form-control" maxlength="30" id="perihal"
                                            name="perihal" placeholder="Masukkan perihal" required
                                            oninvalid="this.setCustomValidity('Masukan perihal')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tujuan_surat">Tujuan Surat</label>
                                        <input type="text" class="form-control" id="tujuan_surat" maxlength="30"
                                            name="tujuan_surat" placeholder="cth: Kapolsek Pangkalan Kuras"
                                            required oninvalid="this.setCustomValidity('Masukan tujuan surat izin')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                        <input type="date" class="form-control" id="tanggal_izin" name="tanggal_izin"
                                            placeholder="Masukkan tanggal pelaksanaan izin" required
                                            oninvalid="this.setCustomValidity('Masukan tanggal pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
                                        <input type="time" class="form-control" id="waktu_izin" maxlength="7"
                                            name="waktu_izin" placeholder="cth: 09:00" required
                                            oninvalid="this.setCustomValidity('Masukan waktu pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="tempat_izin">Tempat Pelaksanaan</label>
                                        <input type="text" class="form-control" id="tempat_izin" maxlength="30"
                                            name="tempat_izin"
                                            placeholder="RT.001 RW.002 Kelurahan Sorek Satu" required
                                            oninvalid="this.setCustomValidity('Masukan tempat pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="jumlah_undangan">Jumlah Undangan</label>
                                        <input type="number" class="form-control" id="jumlah_peserta" maxlength="5"
                                            name="jumlah_peserta" placeholder="5000" required
                                            oninvalid="this.setCustomValidity('Masukan jumlah undangan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="hiburan">Nama Hiburan</label>
                                        <input type="text" class="form-control" id="hiburan" name="hiburan" maxlength="20"
                                            placeholder="Keyboard" required
                                            oninvalid="this.setCustomValidity('Masukan hiburan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
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