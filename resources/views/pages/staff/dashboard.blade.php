@extends('layouts.dashboard')

@section('title', 'Dashboard Staff')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <a href="{{ route('sku-staff.show-sku-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Usaha</h4>
                            </div>
                            <div class="card-body">
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-secondary mr-2">
                                        {{ $skuMasuk }} Belum Diproses
                                    </span>
                                    <span class="badge badge-warning mr-2">
                                        {{ $skuProses }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $skuSelesai }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $skuDitolak }} Ditolak
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <a href="{{ route('ski-staff.show-ski-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background-color: rgb(201, 69, 17)">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Izin</h4>
                            </div>
                            <div class="card-body">
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-secondary mr-2">
                                        {{ $skiMasuk }} Belum Diproses
                                    </span>
                                    <span class="badge badge-warning mr-2">
                                        {{ $skiProses }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $skiSelesai }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $skiDitolak }} Ditolak
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <a href="{{ route('sktm-staff.show-sktm-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background: rgb(116, 104, 3)">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Tidak Mampu</h4>
                            </div>
                            <div class="card-body">
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-secondary mr-2">
                                        {{ $sktmMasuk }} Belum Diproses
                                    </span>
                                    <span class="badge badge-warning mr-2">
                                        {{ $sktmProses }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $sktmSelesai }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $sktmDitolak }} Ditolak
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <a href="{{ route('skp-staff.show-skp-dashboard') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keterangan Pemakaman</h4>
                            </div>
                            <div class="card-body">
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-secondary mr-2">
                                        {{ $skpMasuk }} Belum Diproses
                                    </span>
                                    <span class="badge badge-warning mr-2">
                                        {{ $skpProses }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $skpSelesai }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $skpDitolak }} Ditolak
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('staff.penduduk') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pengguna</h4>
                            </div>
                            <div class="card-body">
                                {{ $dataUser }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <a href="{{ route('staff.all-surat') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-newspaper"></i>
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
        </div>
    </section>
</div>
@endsection

@push('after-styles')
<style>
    h4 {
        color: black !important;
        font-weight: 600 !important;
    }
</style>
@endpush