@extends('layouts.dashboard')

@section('title')
Surat Keterangan Pemakaman
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Keterangan Pemakaman</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#skpbelumproses" onclick="skpBelumProses()" class="nav-link active" id="pills-belum-diproses-tab" data-toggle="pill"
                                    data-target="#pills-belum-diproses" type="button" role="tab"
                                    aria-controls="pills-belum-diproses" aria-selected="true">Belum Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skpsedangproses" onclick="skpSedangProses()" class="nav-link" id="pills-sedang-diproses-tab" data-toggle="pill"
                                    data-target="#pills-sedang-diproses" type="button" role="tab"
                                    aria-controls="pills-sedang-diproses" aria-selected="false">Sedang Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skpselesaiproses" onclick="skpSelesaiProses()" class="nav-link" id="pills-selesai-diproses-tab" data-toggle="pill"
                                    data-target="#pills-selesai-diproses" type="button" role="tab"
                                    aria-controls="pills-selesai-diproses" aria-selected="false">Selesai Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skpditolak" onclick="skpDitolak()" class="nav-link" id="pills-ditolak-tab" data-toggle="pill"
                                    data-target="#pills-ditolak" type="button" role="tab" aria-controls="pills-ditolak"
                                    aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-belum-diproses" role="tabpanel"
                                aria-labelledby="pills-belum-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_staff_belum_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-sedang-diproses" role="tabpanel"
                                aria-labelledby="pills-sedang-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_staff_sedang_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-selesai-diproses" role="tabpanel"
                                aria-labelledby="pills-selesai-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_staff_selesai_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-ditolak" role="tabpanel"
                                aria-labelledby="pills-ditolak-tab">
                                <div class="table-responsive">
                                    <table id="tb_skp_staff_ditolak"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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

@include('pages.staff.skp.modal-tolak-skp')
@include('pages.staff.skp.modal-lampiran-skp')
@endsection

@push('after-scripts')

<script>
    function skpBelumProses(){
        window.location.hash = 'skpbelumproses';
    }
    function skpSedangProses(){
        window.location.hash = 'skpsedangproses';
    }
    function skpSelesaiProses(){
        window.location.hash = 'skpselesaiproses';
    }
    function skpDitolak(){
        window.location.hash = 'skpditolak';
    }

    $(document).ready(function(){
        if(window.location.hash == '#skpbelumproses'){
            $('#pills-belum-diproses-tab').click();
        }
        if(window.location.hash == '#skpsedangproses'){
            $('#pills-sedang-diproses-tab').click();
        }
        if(window.location.hash == '#skpselesaiproses'){
            $('#pills-selesai-diproses-tab').click();
        }
        if(window.location.hash == '#skpditolak'){
            $('#pills-ditolak-tab').click();
        }
    });
</script>

<script>
    $('#tb_skp_staff_belum_diproses').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('skp-staff.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id_surat_keterangan_pemakaman' },
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
    $('#tb_skp_staff_sedang_diproses').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('skp-staff.onProgress') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id_surat_keterangan_pemakaman' },
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
    $('#tb_skp_staff_selesai_diproses').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('skp-staff.success') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id_surat_keterangan_pemakaman' },
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
    $('#tb_skp_staff_ditolak').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('skp-staff.rejected') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id_surat_keterangan_pemakaman' },
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

        // function tolakSKP(id){
        //     $('#tolakSkpModal').modal('show');
        //     $('#id-skp').val(id);
        // }
        
        // $('#form-tolak-skp').submit(function(e){
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         type:'POST',
        //         url: "{{ url('pages/dashboard/staff/skp/tolak-skp') }}",
        //         data: formData,
        //         cache:false,
        //         contentType: false,
        //         processData: false,
        //         success: (data) => {
        //             $('#tolakSkpModal').modal('hide');
        //             $('#tb_skp_staff_ditolak').DataTable().ajax.reload();
        //             Swal.fire({
        //             title: 'Surat Ditolak!',
        //             text: "Surat Keterangan Pemakaman Berhasil Ditolak",
        //             icon: 'error',
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Oke'
        //             }).then((result) => {
        //             if (result.isConfirmed) {
        //             window.location.reload();
        //             }
        //             });
        //         }
        //     });
        // });
        
        // function showRejectSkp(id){
        // $.ajax({
        // type:'POST',
        // url: "{{ url('/pages/dashboard/staff/skp/show/tolak-skp') }}",
        // data: {
        // id: id,
        // _token: "{{ csrf_token() }}"
        // },
        // dataType: 'json',
        // success: (res) => {
        // Swal.fire({
        // title: 'Alasan Penolakan Surat',
        // text: res.alasan_penolakan,
        // icon: 'error',
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        // });
        // }
        // });
        // }

</script>
@endpush