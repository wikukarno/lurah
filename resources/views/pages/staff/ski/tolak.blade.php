@extends('layouts.dashboard')

@section('title')
Tolak Surat Keterangan Izin
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tolak Surat Keterangan Izin</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('staff.tolak-ski', $data->id_surat_keterangan_izin) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_surat_keterangan_izin" id="id_surat_keterangan_izin" value="{{ $data->id_surat_keterangan_izin }}">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Alasan Penolakan</label>
                                        <textarea name="alasan_penolakan" id="alasan_penolakan" maxlength="30"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2">
                                    <a href="{{ route('staff.verifikasi-penduduk') }}" class="btn btn-secondary btn-block">Batal</a>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-danger btn-block">Tolak
                                        Sekarang</button>
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

@push('after-scripts')
@endpush