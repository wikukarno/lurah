@extends('layouts.dashboard')

@section('title')
Data Laporan
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">Data Laporan</h3>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('export.laporan') }}" class="btn btn-primary" target="_blank"> <i
                                        class="fas fa-download"></i>&nbsp;
                                    Download Laporan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_laporan" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Diajukan</th>
                                        <th>Tanggal Disetujui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
<script>
    $('#tb_laporan').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('lurah.laporan') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'no_nik', name: 'no_nik' },
                { data: 'user.name', name: 'user.name' },
                { data: 'jenis_surat', name: 'jenis_surat' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
            ],

        });
</script>
@endpush