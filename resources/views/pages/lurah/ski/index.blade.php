@extends('layouts.dashboard')

@section('title')
Surat Izin Keramaian
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Izin Keramaian</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#skibelumproses" onclick="skiBelumProses()" class="nav-link active" id="pills-belum-diproses-tab"
                                    data-toggle="pill" data-target="#pills-belum-diproses" type="button" role="tab"
                                    aria-controls="pills-belum-diproses" aria-selected="true">Belum Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skiselesaiproses" onclick="skiSelesaiProses()" class="nav-link" id="pills-selesai-diproses-tab"
                                    data-toggle="pill" data-target="#pills-selesai-diproses" type="button" role="tab"
                                    aria-controls="pills-selesai-diproses" aria-selected="false">Selesai Diproses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#skiditolak" onclick="skiDitolak()" class="nav-link" id="pills-ditolak-tab" data-toggle="pill"
                                    data-target="#pills-ditolak" type="button" role="tab" aria-controls="pills-ditolak"
                                    aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-belum-diproses" role="tabpanel"
                                aria-labelledby="pills-belum-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_ski_lurah_belum_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-selesai-diproses" role="tabpanel"
                                aria-labelledby="pills-selesai-diproses-tab">
                                <div class="table-responsive">
                                    <table id="tb_ski_lurah_selesai_diproses"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
                            <div class="tab-pane fade" id="pills-ditolak" role="tabpanel"
                                aria-labelledby="pills-ditolak-tab">
                                <div class="table-responsive">
                                    <table id="tb_ski_lurah_ditolak"
                                        class="table table-hover scroll-horizontal-vertical w-100">
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
        </div>
    </div>
</section>

@include('pages.lurah.ski.modal-lampiran-ski')
@endsection

@push('after-scripts')

<script>
    function skiBelumProses(){
        window.location.hash = 'skibelumproses';
    }
    function skiSedangProses(){
        window.location.hash = 'skisedangproses';
    }
    function skiSelesaiProses(){
        window.location.hash = 'skiselesaiproses';
    }
    function skiDitolak(){
        window.location.hash = 'skiditolak';
    }

    $(document).ready(function(){
        if(window.location.hash == '#skibelumproses'){
            $('#pills-belum-diproses-tab').click();
        }
        if(window.location.hash == '#skisedangproses'){
            $('#pills-sedang-diproses-tab').click();
        }
        if(window.location.hash == '#skiselesaiproses'){
            $('#pills-selesai-diproses-tab').click();
        }
        if(window.location.hash == '#skiditolak'){
            $('#pills-ditolak-tab').click();
        }
    });
</script>

<script>
    $('#tb_ski_lurah_belum_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('ski-lurah.index') }}",
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
    $('#tb_ski_lurah_sedang_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('ski-lurah.onProgress') }}",
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
    $('#tb_ski_lurah_selesai_diproses').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('ski-lurah.success') }}",
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
    $('#tb_ski_lurah_ditolak').DataTable({
    processing: true,
    serverSide: true,
    ordering: [[1, 'asc']],
    ajax: {
    url: "{{ route('ski-lurah.rejected') }}",
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

        function tolakSKI(id){
        $('#tolakSkiModal').modal('show');
        $('#id-ski').val(id);
        }

        $('#form-tolak-ski').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/lurah/ski/tolak-ski') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $('#tolakSkiModal').modal('hide');
        $('#tb_ski_lurah').DataTable().ajax.reload();
        Swal.fire({
        title: 'Surat Berhasil Ditolak!',
        text: "Surat Keterangan Usaha telah ditolak",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
        })
        }
        });
        });

        function lampiranSkiLurah(id){
        $('#lampiranSkiModal').modal('show');
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/lurah/ski/get-lampiran') }}",
        data: {
        id:id,
        _token: '{{csrf_token()}}'
        },
        success: (data) => {
        console.log(data);
        $('#no_nik').val(data.no_nik);
        $('#nama').val(data.nama);
        $('#nama_izin').val(data.nama_izin);
        $('#tempat_lahir').val(data.tempat_lahir);
        $('#tanggal_lahir').val(data.tanggal_lahir);
        $('#jenis_kelamin').val(data.jenis_kelamin);
        $('#pekerjaan').val(data.pekerjaan);
        $('#status_perkawinan').val(data.status_perkawinan);
        $('#agama').val(data.agama);
        $('#kecamatan').val(data.kecamatan);
        $('#kelurahan').val(data.kelurahan);
        $('#rt_rw').val(data.rt_rw);
        $('#alamat').val(data.alamat);
        $('#tanggal_pelaksanaan_izin').val(data.tanggal_pelaksanaan_izin);
        $('#waktu_pelaksanaan_izin').val(data.waktu_pelaksanaan_izin);
        $('#tempat_pelaksanaan_izin').val(data.tempat_pelaksanaan_izin);
        $('#jumlah_undangan').val(data.jumlah_undangan);
        $('#hiburan').val(data.hiburan);
        $('#perihal').val(data.perihal);
        $('#tujuan').val(data.tujuan_surat_izin);
        
        $('#ktp').attr('src', '{{ asset('storage') }}/'+data.ktp);
        $('#kk').attr('src', '{{ asset('storage') }}/'+data.kk);
        $('#surat_rt_rw').attr('src', '{{ asset('storage') }}/'+data.surat_rt_rw);
        }
        });
        }

        function showRejectSki(id){
        $.ajax({
        type:'POST',
        url: "{{ url('/pages/dashboard/lurah/ski/show/tolak-ski') }}",
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