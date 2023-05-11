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
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <div class="mx-auto-my-auto font-statistik">
                            {{ $sku }}
                        </div>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Surat Keterangan Usaha</h4>
                        </div>
                        <div class="card-body">
                            <div class="keterangan d-md-flex d-lg-flex mt-2">
                                <a href="#skubelumproses" onclick="skuBelumProses()" class="badge badge-secondary mr-2">
                                    {{ $skuMasuk }} Belum Diproses
                                </a>
                                <a href="#skusedangproses" onclick="skuSedangProses()" class="badge badge-warning mr-2">
                                    {{ $skuProses }} Diproses
                                </a>
                                <a href="#skuselesaiproses" onclick="skuSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $skuSelesai }} Selesai
                                </a>
                                <a href="#skuditolak" onclick="skuDitolak()" class="badge badge-danger mr-2">
                                    {{ $skuDitolak }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
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
                                    {{ $skpMasuk }} Belum Diproses
                                </a>
                                <a href="#skpsedangproses" onclick="skpSedangProses()" class="badge badge-warning mr-2">
                                    {{ $skpProses }} Diproses
                                </a>
                                <a href="#skpselesai" onclick="skpSelesaiProses()" class="badge badge-success mr-2">
                                    {{ $skpSelesai }} Selesai
                                </a>
                                <a href="#skpditolak" onclick="skpDitolak()" class="badge badge-danger mr-2">
                                    {{ $skpDitolak }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background: rgb(116, 104, 3)">
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
                                    {{ $sktmMasuk }} Belum Diproses
                                </a>
                                <a href="#sktmsedangproses" onclick="sktmSedangProses()"
                                    class="badge badge-warning mr-2">
                                    {{ $sktmProses }} Diproses
                                </a>
                                <a href="#sktmselesaiproses" onclick="sktmSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $sktmSelesai }} Selesai
                                </a>
                                <a href="#sktmditolak" onclick="sktmDitolak()" class="badge badge-danger mr-2">
                                    {{ $sktmDitolak }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background-color: rgb(201, 69, 17)">
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
                                    {{ $skiMasuk }} Belum Diproses
                                </a>
                                <a href="#skisedangproses" onclick="skiSedangProses()" class="badge badge-warning mr-2">
                                    {{ $skiProses }} Diproses
                                </a>
                                <a href="#skiselesaiproses" onclick="skiSelesaiProses()"
                                    class="badge badge-success mr-2">
                                    {{ $skiSelesai }} Selesai
                                </a>
                                <a href="#skiditolak" onclick="skiDitolak()" class="badge badge-danger mr-2">
                                    {{ $skiDitolak }} Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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

@push('after-scripts')
<script>
    // Url Hash for sku
        function skuBelumProses() {
                window.location.href = "{{ route('sku-staff.index') }}#skubelumproses";
            }
        function skuSedangProses() {
            window.location.href = "{{ route('sku-staff.index') }}#skusedangproses";
        }
        function skuSelesaiProses() {
            window.location.href = "{{ route('sku-staff.index') }}#skuselesaiproses";
        }
        function skuDitolak() {
            window.location.href = "{{ route('sku-staff.index') }}#skuditolak";
        }
    
        // Url Hash for skp
        function skpBelumProses() {
            window.location.href = "{{ route('skp-staff.index') }}#skpbelumproses";
        }
        function skpSedangProses() {
            window.location.href = "{{ route('skp-staff.index') }}#skpsedangproses";
        }
        function skpSelesaiProses() {
            window.location.href = "{{ route('skp-staff.index') }}#skpselesaiproses";
        }
        function skpDitolak() {
            window.location.href = "{{ route('skp-staff.index') }}#skpditolak";
        }
    
        // Url Hash for sktm
        function sktmBelumProses() {
            window.location.href = "{{ route('sktm-staff.index') }}#sktmbelumproses";
        }
        function sktmSedangProses() {
            window.location.href = "{{ route('sktm-staff.index') }}#sktmsedangproses";
        }
        function sktmSelesaiProses() {
            window.location.href = "{{ route('sktm-staff.index') }}#sktmselesaiproses";
        }
        function sktmDitolak() {
            window.location.href = "{{ route('sktm-staff.index') }}#sktmditolak";
        }
    
        // Url Hash for ski
        function skiBelumProses() {
            window.location.href = "{{ route('ski-staff.index') }}#skibelumproses";
        }
        function skiSedangProses() {
            window.location.href = "{{ route('ski-staff.index') }}#skisedangproses";
        }
        function skiSelesaiProses() {
            window.location.href = "{{ route('ski-staff.index') }}#skiselesaiproses";
        }
        function skiDitolak() {
            window.location.href = "{{ route('ski-staff.index') }}#skiditolak";
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