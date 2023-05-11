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
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#skubelumproses" onclick="skuBelumProses()" class="nav-link active" id="pills-belum-diproses-tab"
                                    data-toggle="pill" data-target="#pills-belum-diproses" type="button" role="tab"
                                    aria-controls="pills-belum-diproses" aria-selected="true">Belum Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skuselesaiproses" onclick="skuSelesaiProses()" class="nav-link" id="pills-selesai-diproses-tab"
                                    data-toggle="pill" data-target="#pills-selesai-diproses" type="button" role="tab"
                                    aria-controls="pills-selesai-diproses" aria-selected="false">Selesai Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skuditolak" onclick="skuDitolak()" class="nav-link" id="pills-ditolak-tab" data-toggle="pill"
                                    data-target="#pills-ditolak" type="button" role="tab" aria-controls="pills-ditolak"
                                    aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-belum-diproses" role="tabpanel"
                                aria-labelledby="pills-belum-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_sku_lurah_belum_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-selesai-diproses" role="tabpanel"
                                aria-labelledby="pills-selesai-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_sku_lurah_selesai_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-ditolak" role="tabpanel"
                                aria-labelledby="pills-ditolak-tab">
                                <div class="table-responsive">
                                    <table id="tb_sku_lurah_ditolak"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
        </div>
    </div>
</section>
@include('pages.lurah.sku.modal-lampiran-sku')
@endsection

@push('after-scripts')
<script>
    function skuBelumProses(){
        window.location.hash = 'skubelumproses';
    }

    function skuSedangProses(){
        window.location.hash = 'skusedangproses';
    }

    function skuSelesaiProses(){
        window.location.hash = 'skuselesaiproses';
    }

    function skuDitolak(){
        window.location.hash = 'skuditolak';
    }

    $(document).ready(function(){
        // get hash on url
        var hash = window.location.hash;
        if(hash == '#skusedangproses'){
            $('#pills-sedang-diproses-tab').click();
        }else if(hash == '#skuselesaiproses'){
            $('#pills-selesai-diproses-tab').click();
        }else if(hash == '#skuditolak'){
            $('#pills-ditolak-tab').click();
        }
    });
</script>

<script>
    $('#tb_sku_lurah_belum_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('sku-lurah.index') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'user.nama', name: 'user.nama' },
    { data: 'nama_usaha', name: 'nama_usaha' },
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
    
    $('#tb_sku_lurah_selesai_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('sku-lurah.success') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'user.nama', name: 'user.nama' },
    { data: 'nama_usaha', name: 'nama_usaha' },
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
    
    $('#tb_sku_lurah_ditolak').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('sku-lurah.rejected') }}",
    },
    columns: [
    { data: 'DT_RowIndex', name: 'id' },
    { data: 'user.nama', name: 'user.nama' },
    { data: 'nama_usaha', name: 'nama_usaha' },
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
                text: "Surat Keterangan Usaha Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke'
            })
        }

        function lampiranSku(id){
        $('#lampiranSkuModal').modal('show');
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/lurah/sku/get-lampiran') }}",
        data: {
        id:id,
        _token: '{{csrf_token()}}'
        },
        success: (data) => {
        $('#sku_no_nik').val(data.no_nik);
        $('#sku_nama').val(data.nama);
        $('#sku_nama_usaha').val(data.nama_usaha);
        $('#sku_tempat_lahir').val(data.tempat_lahir);
        $('#sku_tanggal_lahir').val(data.tanggal_lahir);
        $('#sku_jenis_kelamin').val(data.jenis_kelamin);
        $('#sku_pekerjaan').val(data.pekerjaan);
        $('#sku_status_perkawinan').val(data.status_perkawinan);
        $('#sku_agama').val(data.agama);
        $('#sku_kecamatan').val(data.kecamatan);
        $('#sku_kelurahan').val(data.kelurahan);
        $('#sku_rt_rw').val(data.rt_rw);
        $('#sku_alamat').val(data.alamat);
        $('#ktp').attr('src', '{{ asset('storage') }}/'+data.ktp);
        $('#kk').attr('src', '{{ asset('storage') }}/'+data.kk);
        $('#surat_rt_rw').attr('src', '{{ asset('storage') }}/'+data.surat_rt_rw);
        }
        });
        }

        function showRejectSku(id){
        $.ajax({
        type:'POST',
        url: "{{ url('/pages/dashboard/lurah/sku/show/tolak-sku') }}",
        data: {
        id: id,
        _token: "{{ csrf_token() }}"
        },
        dataType: 'json',
        success: (res) => {
        Swal.fire({
        title: 'Alasan Penolakan Surat',
        text: res.alasan_penolakan,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        });
        }
        });
        }

</script>
@endpush