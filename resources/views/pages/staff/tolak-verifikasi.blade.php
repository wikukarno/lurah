@extends('layouts.dashboard')

@section('title')
Verifikasi Pengguna
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('staff.tolak-verifikasi', $data->id) }}" method="POST">
                            @csrf
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
                                <div class="col-12 col-lg-6">
                                    <a href="{{ route('staff.verifikasi-penduduk') }}" class="btn btn-secondary btn-block">Batal</a>
                                </div>
                                <div class="col-12 col-lg-6">
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