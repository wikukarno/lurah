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
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-warning mr-2">
                                        {{ $getBusinessOnProgress }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $getBusinessFinished }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $getBusinessRejected }} Ditolak
                                    </span>
                                </div>
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
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-warning mr-2">
                                        {{ $getPermitsOnProgress }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $getPermitsFinished }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $getPermitsRejected }} Ditolak
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
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-warning mr-2">
                                        {{ $getIncapacityOnProgress }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $getIncapacityFinished }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $getIncapacityRejected }} Ditolak
                                    </span>
                                </div>
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
                                <div class="keterangan d-md-flex d-lg-flex mt-2">
                                    <span class="badge badge-warning mr-2">
                                        {{ $getFuneralsOnProgress }} Diproses
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        {{ $getFuneralsFinished }} Selesai
                                    </span>
                                    <span class="badge badge-danger mr-2">
                                        {{ $getFuneralsRejected }} Ditolak
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