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
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('sku-user.show-sku-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Usaha</h4>
                            </div>
                            <div class="card-body">
                                {{ $getBusiness }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm6 col-12">
                <a href="{{ route('ski-user.show-ski-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Izin</h4>
                            </div>
                            <div class="card-body">
                                {{ $getPermits }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('sktm-user.show-sktm-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Tidak Mampu</h4>
                            </div>
                            <div class="card-body">
                                {{ $getIncapacity }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('skp-user.show-skp-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Pemakaman</h4>
                            </div>
                            <div class="card-body">
                                {{ $getFunerals }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('user.show-surat-user-dashboard') }}">
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
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('user.show-surat-ditolak-dashboard') }}">
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
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('user.show-surat-diproses-dashboard') }}">
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
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('user.show-surat-selesai-dashboard') }}">
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
                </a>
            </div>
        </div>
    </section>
</div>
@endsection