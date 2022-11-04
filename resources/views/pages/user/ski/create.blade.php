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
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">NIK</label>
                                        <input type="number" class="form-control" id="no_nik" name="no_nik"
                                            placeholder="Masukkan nomor nik" required
                                            oninvalid="this.setCustomValidity('Masukan nomor NIK')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan nama" required
                                            oninvalid="this.setCustomValidity('Masukan nama')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Nama Izin</label>
                                        <input type="text" class="form-control" id="nama_izin" name="nama_izin"
                                            placeholder="Masukkan nama izin" required
                                            oninvalid="this.setCustomValidity('Masukan nama izin')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Masukkan tempat lahir" required
                                            oninvalid="this.setCustomValidity('Masukan tampat lahir')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            placeholder="Masukkan tanggal lahir" required
                                            oninvalid="this.setCustomValidity('masukan tanggal lahir')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan pekerjaan" required
                                            oninvalid="this.setCustomValidity('Masukan pekerjaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan alamat" required
                                            oninvalid="this.setCustomValidity('Masukan alamat')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" class="form-control" id="perihal" name="perihal"
                                            placeholder="Masukkan perihal" required
                                            oninvalid="this.setCustomValidity('Masukan perihal')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tujuan_surat_izin">Tujuan Surat</label>
                                        <input type="text" class="form-control" id="tujuan_surat_izin"
                                            name="tujuan_surat_izin" placeholder="cth: Kapolsek Pangkalan Kuras"
                                            required oninvalid="this.setCustomValidity('Masukan tujuan surat izin')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                        <input type="text" class="form-control" id="tanggal_pelaksanaan_izin"
                                            name="tanggal_pelaksanaan_izin"
                                            placeholder="Masukkan tanggal pelaksanaan izin" required
                                            oninvalid="this.setCustomValidity('Masukan tanggal pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
                                        <input type="text" class="form-control" id="waktu_pelaksanaan_izin"
                                            name="waktu_pelaksanaan_izin" placeholder="cth: 09:00 wib" required
                                            oninvalid="this.setCustomValidity('Masukan waktu pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                                        <input type="text" class="form-control" id="tempat_pelaksanaan"
                                            name="tempat_pelaksanaan_izin"
                                            placeholder="RT.001 RW.002 Kelurahan Sorek Satu" required
                                            oninvalid="this.setCustomValidity('Masukan tempat pelaksanaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jumlah_undangan">Jumlah Undangan</label>
                                        <input type="text" class="form-control" id="jumlah_undangan"
                                            name="jumlah_undangan" placeholder="5000 orang" required
                                            oninvalid="this.setCustomValidity('Masukan jumlah undangan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hiburan">Nama Hiburan</label>
                                        <input type="text" class="form-control" id="hiburan" name="hiburan"
                                            placeholder="Keyboard" required
                                            oninvalid="this.setCustomValidity('Masukan hiburan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Foto KTP</label>
                                        <input type="file" class="form-control" id="ktp" name="ktp" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Foto KK</label>
                                        <input type="file" class="form-control" id="kk" name="kk" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW</label>
                                        <input type="file" class="form-control" id="surat_rt_rw" name="surat_rt_rw"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-6">
                                    <a href="{{ route('ski-user.index') }}" type="button"
                                        class="btn btn-danger btn-block">Batal</a>
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