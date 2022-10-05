@extends('layouts.dashboard')

@section('title')
Surat Keterangan Usaha
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Keterangan Usaha</h3>
                            <a href="{{ route('sku-user.create') }}" class="btn btn-primary"> <i
                                    class="fas fa-plus"></i>&nbsp;
                                Tambah Surat</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_sku" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Posisi</th>
                                        <th>Aksi</th>
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
    $('#tb_sku').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('sku-user.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'nama_usaha', name: 'nama_usaha' },
                { data: 'created_at', name: 'created_at' },
                { data: 'posisi', name: 'posisi' },
                { 
                    data: 'status', 
                    name: 'status', 
                },
            ],

        });

        function selesaiProses(id){
            Swal.fire({
                title: 'Surat Selesai Diproses!',
                text: "Surat Keterangan Usaha anda telah selesai diproses, silahkan ambil surat anda di kantor desa",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke'
            })
        }

        function penolakan(id){
        $.ajax({
        type: "POST",
        url: "{{ route('get-penolakan') }}",
        data: {
        id: id,
        _token: "{{ csrf_token() }}"
        },
        dataType: "JSON",
        success: function (response) {
        Swal.fire({
        title: 'Surat Ditolak!',
        text: "Keterangan Penolakan : " +response.alasan_penolakan,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
        });
        }
        });
        }

</script>
@endpush