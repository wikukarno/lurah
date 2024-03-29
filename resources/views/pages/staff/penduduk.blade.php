@extends('layouts.dashboard')

@section('title')
Data Penduduk
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_penduduk" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat</th>
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
    $('#tb_penduduk').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('staff.penduduk') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'email', name: 'email' },
                { data: 'nama', name: 'nama' },
                { data: 'no_telepon', name: 'no_telepon' },
                { data: 'alamat', name: 'alamat' },
            ],

        });
</script>
@endpush