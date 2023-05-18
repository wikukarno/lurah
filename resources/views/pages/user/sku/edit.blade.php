@extends('layouts.dashboard')

@section('title')
Update Surat Keterangan Usaha
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Surat Keterangan Usaha</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sku-user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" maxlength="30" value="{{ $item->nama_usaha }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Jenis Usaha <span class="text-danger">*</span></label>
                                        <select name="jenis_usaha" id="jenis_usaha" class="form-control" required>
                                            <option value="">Pilih jenis usaha</option>
                                            <option value="Perdagangan" {{ $item->jenis_usaha == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                            <option value="Jasa" {{ $item->jenis_usaha == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                            <option value="Industri" {{ $item->jenis_usaha == 'Industri' ? 'selected' : '' }}>Industri</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW &nbsp; (.jpg .png)</label>
                                        <input type="file" class="form-control" id="surat_rtrw" name="surat_rtrw">
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