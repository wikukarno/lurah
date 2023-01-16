@extends('layouts.dashboard')

@section('title')
Surat Keterangan Pemakaman
@endsection

@section('content')
@if (count($userDetails) > 0)
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Keterangan Pemakaman</h3>
                            <a href="{{ route('skp-user.create') }}" class="btn btn-primary"> <i
                                    class="fas fa-plus"></i>&nbsp;
                                Tambah Surat</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link active" id="pills-belum-diproses-tab" data-toggle="pill"
                                    data-target="#pills-belum-diproses" type="button" role="tab" aria-controls="pills-belum-diproses"
                                    aria-selected="true">Belum Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" id="pills-sedang-diproses-tab" data-toggle="pill"
                                    data-target="#pills-sedang-diproses" type="button" role="tab" aria-controls="pills-sedang-diproses"
                                    aria-selected="false">Sedang Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" id="pills-selesai-diproses-tab" data-toggle="pill"
                                    data-target="#pills-selesai-diproses" type="button" role="tab" aria-controls="pills-selesai-diproses"
                                    aria-selected="false">Selesai Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" id="pills-ditolak-tab" data-toggle="pill" data-target="#pills-ditolak"
                                    type="button" role="tab" aria-controls="pills-ditolak" aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-belum-diproses" role="tabpanel"
                                aria-labelledby="pills-belum-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_user_belum_diproses" class="table table-hover scroll-horizontal-vertical w-100">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Alm/Almh</th>
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
                            <div class="tab-pane fade" id="pills-sedang-diproses" role="tabpanel" aria-labelledby="pills-sedang-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_user_sedang_diproses" class="table table-hover scroll-horizontal-vertical w-100">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Alm/Almh</th>
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
                            <div class="tab-pane fade" id="pills-selesai-diproses" role="tabpanel" aria-labelledby="pills-selesai-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_user_selesai_diproses" class="table table-hover scroll-horizontal-vertical w-100">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Alm/Almh</th>
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
                            <div class="tab-pane fade" id="pills-ditolak" role="tabpanel" aria-labelledby="pills-ditolak-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_user_ditolak" class="table table-hover scroll-horizontal-vertical w-100">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Alm/Almh</th>
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
        </div>
    </div>
</section>
@else
<section class="main-content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{ asset('assets/img/data.svg') }}" class="figure-img img-fluid" alt="">
                            <figcaption class="figure-caption mt-5">
                                <h3 class="text-center">Data Anda Belum Lengkap</h3>
                                <p class="text-center">Silahkan Lengkapi Profile Anda Terlebih Dahulu</p>
                                <a href="{{ route('complete-profile') }}" class="btn btn-primary"> <i
                                        class="fas fa-plus"></i>&nbsp;
                                    Lengkapi Data</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('after-scripts')
<script>
    $('#tb_skp_user_belum_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('skp-user.index') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'nama', name: 'nama' },
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
    $('#tb_skp_user_sedang_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('skp-user.onProgress') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'nama', name: 'nama' },
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
    $('#tb_skp_user_selesai_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('skp-user.success') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'nama', name: 'nama' },
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
    $('#tb_skp_user_ditolak').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('skp-user.rejected') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'nama', name: 'nama' },
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

        function selesaiProses(id){
            Swal.fire({
                title: 'Surat Selesai Diproses!',
                text: "Surat Keterangan Pemakaman Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
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