@extends('layouts.dashboard')

@section('title')
Update Surat Keterangan Tidak Mampu
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Surat Keterangan Tidak Mampu</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sktm-user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="tujuan_surat">Keperluan Surat</label>
                                        <input type="text" class="form-control" id="tujuan" name="tujuan" maxlength="30" value="{{ $item->tujuan }}">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Foto Surat Keterangan RT/RW &nbsp; (.jpg .png)</label>
                                        <input type="file" class="form-control" id="surat_rtrw" name="surat_rtrw">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-12 col-lg-6">
                                    <a href="{{ route('sktm-user.index') }}" class="btn btn-danger btn-block">Batal</a>
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