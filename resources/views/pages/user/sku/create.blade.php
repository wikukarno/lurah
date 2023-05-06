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
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha"
                                            maxlength="30" placeholder="Masukkan nama usaha" required
                                            oninvalid="this.setCustomValidity('Masukan nama usaha')"
                                            oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Usaha <span class="text-danger">*</span></label>
                                        <select name="jenis_usaha" id="jenis_usaha" class="form-control" required>
                                            <option value="">Pilih jenis usaha</option>
                                            <option value="Perdagangan">Perdagangan</option>
                                            <option value="Jasa">Jasa</option>
                                            <option value="Industri">Industri</option>
                                        </select>
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
                                        <label for="nama">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik"
                                            value="{{ Auth::user()->nik }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ Auth::user()->nama }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ Auth::user()->tempat_lahir }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ Auth::user()->tanggal_lahir }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Kelamin</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->jenis_kelamin }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan pekerjaan" value="{{ Auth::user()->pekerjaan }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Status Perkawinan</label>
                                        <input type="text" class="form-control" id="status_perkawinan"
                                            value="{{ Auth::user()->status_perkawinan }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Agama</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->agama }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            value="{{ Auth::user()->kecamatan }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ Auth::user()->address }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KTP Asli</label>
                                        <figure class="figure">
                                            <img src="{{ Storage::url(Auth::user()->ktp) }}"
                                                class="figure-img img-fluid rounded" alt="ktp">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto KK Asli</label>
                                        <figure class="figure">
                                            <img src="{{ Storage::url(Auth::user()->kk) }}"
                                                class="figure-img img-fluid rounded" alt="kk">
                                        </figure>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-6">
                                    <a href="{{ route('sku-user.index') }}" class="btn btn-danger btn-block">Batal</a>
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