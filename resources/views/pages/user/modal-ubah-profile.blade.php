<div class="modal fade" id="ubahProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="form-update-profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_profile" id="id_profile">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nik">Nik</label>
                                    <input type="number" class="form-control" id="nik" name="nik">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="Laki-laki" @if (Auth::user()->jenis_kelamin ==
                                            'Laki-laki')
                                            selected
                                            @endif>Laki-laki</option>
                                        <option value="Perempuan" @if (Auth::user()->jenis_kelamin ==
                                            'Perempuan')
                                            selected
                                            @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="rtrw">RT/RW</label>
                                    <input type="text" class="form-control" id="rtrw" name="rtrw">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="Islam" @if (Auth::user()->agama == 'Islam') selected
                                            @endif>Islam</option>
                                        <option value="Kristen" @if (Auth::user()->agama == 'Kristen') selected
                                            @endif>Kristen</option>
                                        <option value="Katholik" @if (Auth::user()->agama == 'Katholik')
                                            selected
                                            @endif>Katholik</option>
                                        <option value="Hindu" @if (Auth::user()->agama == 'Hindu') selected
                                            @endif>Hindu</option>
                                        <option value="Budha" @if (Auth::user()->agama == 'Budha') selected
                                            @endif>Budha</option>
                                        <option value="Konghucu" @if (Auth::user()->agama == 'Konghucu')
                                            selected
                                            @endif>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                                        <option value="Belum Kawin" @if (Auth::user()->status_perkawinan ==
                                            'Belum
                                            Kawin')
                                            selected
                                            @endif>Belum Kawin</option>
                                        <option value="Kawin" @if (Auth::user()->status_perkawinan == 'Kawin')
                                            selected
                                            @endif>Kawin</option>
                                        <option value="Cerai Hidup" @if (Auth::user()->status_perkawinan ==
                                            'Cerai
                                            Hidup')
                                            selected
                                            @endif>Cerai Hidup</option>
                                        <option value="Cerai Mati" @if (Auth::user()->status_perkawinan ==
                                            'Cerai
                                            Mati')
                                            selected
                                            @endif>Cerai Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="ktp">Upload KTP</label>
                                    <input type="file" class="form-control" id="ktp" name="ktp">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="kk">Upload KK</label>
                                    <input type="file" class="form-control" id="kk" name="kk">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="kk">Upload Foto Profile</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address">
                                        {{ $users->userDetails->address ?? '' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <a href="{{ route('akun-user.index') }}" class="btn btn-danger btn-block mb-3">Batal</a>
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