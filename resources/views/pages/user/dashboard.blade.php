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
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <div class="mx-auto my-auto font-statistik">
                            {{ $sku }}
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keterangan Usaha</h4>
                        </div>
                        <div class="card-body">
                            <div class="keterangan d-md-flex d-lg-flex mt-2">
                                <a href="#skubelumproses" onclick="skuBelumDiproses()"
                                    class="badge badge-secondary mr-2">
                                    {{ $getBusinessNotProcessed }} Belum Diproses
                                </a>
                                <a href="#skusedangdiproses" onclick="skuSedangDiproses()"
                                    class="badge badge-warning mr-2">
                                    {{ $getBusinessOnProgress }} Diproses
                                </a>
                                <a href="#skuselesaiproses" onclick="skuSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $getBusinessFinished }} Selesai
                                </a>
                                <a href="#skuditolak" onclick="skuDitolak()" class="badge badge-danger mr-2">
                                    {{ $getBusinessRejected }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <div class="mx-auto my-auto font-statistik">
                            {{ $skp }}
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keterangan Pemakaman</h4>
                        </div>
                        <div class="card-body">
                            <div class="keterangan d-md-flex d-lg-flex mt-2">
                                <a href="#skpbelumproses" onclick="skpBelumProses()" class="badge badge-secondary mr-2">
                                    {{ $getFuneralsNotProcessed }} Belum Diproses
                                </a>
                                <a href="#skpsedangproses" onclick="skpSedangProses()" class="badge badge-warning mr-2">
                                    {{ $getFuneralsOnProgress }} Diproses
                                </a>
                                <a href="#skpselesaiproses" onclick="skpSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $getFuneralsFinished }} Selesai
                                </a>
                                <a href="#skpditolak" onclick="skpDitolak()" class="badge badge-danger mr-2">
                                    {{ $getFuneralsRejected }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <div class="mx-auto my-auto font-statistik">
                            {{ $sktm }}
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keterangan Tidak Mampu</h4>
                        </div>
                        <div class="card-body">
                            <div class="keterangan d-md-flex d-lg-flex mt-2">
                                <a href="#sktmbelumproses" onclick="sktmBelumProses()"
                                    class="badge badge-secondary mr-2">
                                    {{ $getIncapacityNotProcessed }} Belum Diproses
                                </a>
                                <a href="#sktmsedangproses" onclick="sktmSedangProses()"
                                    class="badge badge-warning mr-2">
                                    {{ $getIncapacityOnProgress }} Diproses
                                </a>
                                <a href="#sktmselesaiproses" onclick="sktmSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $getIncapacityFinished }} Selesai
                                </a>
                                <a href="#sktmditolak" onclick="sktmDitolak()" class="badge badge-danger mr-2">
                                    {{ $getIncapacityRejected }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <div class="mx-auto my-auto font-statistik">
                            {{ $ski }}
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keterangan Izin</h4>
                        </div>
                        <div class="card-body">
                            <div class="keterangan d-md-flex d-lg-flex mt-2">
                                <a href="#skibelumproses" onclick="skiBelumProses()" class="badge badge-secondary mr-2">
                                    {{ $getPermitsNotProcessed }} Belum Diproses
                                </a>
                                <a href="#skisedangproses" onclick="skiSedangProses()" class="badge badge-warning mr-2">
                                    {{ $getPermitsOnProgress }} Diproses
                                </a>
                                <a href="#skiselesaiproses" onclick="skiSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $getPermitsFinished }} Selesai
                                </a>
                                <a href="#skiditolak" onclick="skiDitolak()" class="badge badge-danger mr-2">
                                    {{ $getPermitsRejected }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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

@push('after-scripts')
<script>
    // Url Hash for sku
    function skuBelumDiproses() {
            window.location.href = "{{ route('sku-user.index') }}#skubelumproses";
        }
    function skuSedangDiproses() {
        window.location.href = "{{ route('sku-user.index') }}#skusedangproses";
    }
    function skuSelesaiProses() {
        window.location.href = "{{ route('sku-user.index') }}#skuselesaiproses";
    }
    function skuDitolak() {
        window.location.href = "{{ route('sku-user.index') }}#skuditolak";
    }

    // Url Hash for skp
    function skpBelumProses() {
        window.location.href = "{{ route('skp-user.index') }}#skpbelumproses";
    }
    function skpSedangProses() {
        window.location.href = "{{ route('skp-user.index') }}#skpsedangproses";
    }
    function skpSelesaiProses() {
        window.location.href = "{{ route('skp-user.index') }}#skpselesaiproses";
    }
    function skpDitolak() {
        window.location.href = "{{ route('skp-user.index') }}#skpditolak";
    }

    // Url Hash for sktm
    function sktmBelumProses() {
        window.location.href = "{{ route('sktm-user.index') }}#sktmbelumproses";
    }
    function sktmSedangProses() {
        window.location.href = "{{ route('sktm-user.index') }}#sktmsedangproses";
    }
    function sktmSelesaiProses() {
        window.location.href = "{{ route('sktm-user.index') }}#sktmselesaiproses";
    }
    function sktmDitolak() {
        window.location.href = "{{ route('sktm-user.index') }}#sktmditolak";
    }

    // Url Hash for ski
    function skiBelumProses() {
        window.location.href = "{{ route('ski-user.index') }}#skibelumproses";
    }
    function skiSedangProses() {
        window.location.href = "{{ route('ski-user.index') }}#skisedangproses";
    }
    function skiSelesaiProses() {
        window.location.href = "{{ route('ski-user.index') }}#skiselesaiproses";
    }
    function skiDitolak() {
        window.location.href = "{{ route('ski-user.index') }}#skiditolak";
    }
</script>
@endpush


@push('after-styles')
<style>
    h4 {
        color: black !important;
        font-weight: 600 !important;
    }

    .font-statistik {
        font-weight: 700 !important;
        font-size: 24px !important;
        color: #fff !important;
    }
</style>
@endpush