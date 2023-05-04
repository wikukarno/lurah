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
                        <form action="{{ route('kategori-surat.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Kategori Surat</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-4">
                                <div class="col-12 col-lg-6">
                                    <a href="{{ route('kategori-surat.index') }}" type="button"
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