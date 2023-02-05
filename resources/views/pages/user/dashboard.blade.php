@extends('layouts.dashboard')

@section('title', 'Dashboard User')
    

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Semua Surat</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSurat }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Ditolak</h4>
                        </div>
                        <div class="card-body">
                            {{ $getSuratDitolak }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Sedang Diproses</h4>
                        </div>
                        <div class="card-body">
                            {{ $getSuratDiproses }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Selesai Diproses</h4>
                        </div>
                        <div class="card-body">
                            {{ $getSuratSelesai }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection