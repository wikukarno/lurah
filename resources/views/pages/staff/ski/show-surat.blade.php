@extends('layouts.dashboard')

@section('title')
Surat Keterangan Izin
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Daftar Surat Izin</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_ski_staff" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nama Izin</th>
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
    $('#tb_ski_staff').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ route('ski-staff.show-ski-dashboard') }}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'user.nama', name: 'user.nama' },
            { data: 'nama_izin', name: 'nama_izin' },
            { data: 'created_at', name: 'created_at' },
            { data: 'posisi', name: 'posisi' },
            {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
            },
        ],
    });

    function selesaiProses(){
        Swal.fire({
            title: 'Surat Selesai Diproses!',
            text: "Surat Keterangan Izin Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        })
    }

</script>
@endpush