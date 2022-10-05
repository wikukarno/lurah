@extends('layouts.dashboard')

@section('title')
Surat Keterangan Usaha
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Surat Keterangan Usaha</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sku-user.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="nama">Nama Usaha</label>
                                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha"
                                            placeholder="Masukkan nama usaha" required
                                            oninvalid="this.setCustomValidity('Masukan nama usaha')"
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
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan pekerjaan" required
                                            oninvalid="this.setCustomValidity('Masukan pekerjaan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Status Perkawinan</label>
                                        <input type="text" class="form-control" id="status_perkawinan"
                                            name="status_perkawinan" placeholder="Masukkan status perkawinan" required
                                            oninvalid="this.setCustomValidity('Masukan status perkawinan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            placeholder="Masukkan kecamatan" required
                                            oninvalid="this.setCustomValidity('Masukan kecamatan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="nama">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                            placeholder="Masukkan kelurahan" required
                                            oninvalid="this.setCustomValidity('Masukan kelurahan')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">RT / RW</label>
                                        <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                            placeholder="Masukkan RT/RW" required
                                            oninvalid="this.setCustomValidity('Masukan RT/RW')"
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Lampiran (Ktp, KK, Surat Keterangan Rt/RW)</label>
                                        <input type="file" class="form-control" id="lampiran" name="lampiran[]" multiple
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger btn-block"
                                        data-dismiss="modal">Batal</button>
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