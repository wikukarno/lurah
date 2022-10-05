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
                        <div class="table-responsive">
                            <table id="tb_ski_lurah" class="table table-hover scroll-horizontal-vertical w-100">
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

@include('pages.lurah.ski.modal-lampiran-ski')
@endsection

@push('after-scripts')
<script>
    $('#tb_ski_lurah').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('ski-lurah.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'nama', name: 'nama' },
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
                text: "Surat Keterangan Usaha anda telah selesai diproses, silahkan ambil surat anda di kantor desa",
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
        url: "{{ url('pages/dashboard/staff/ski/tolak-ski') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $('#tolakSkiModal').modal('hide');
        $('#tb_ski_staff').DataTable().ajax.reload();
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
                    $('#ski_no_nik').val(data.no_nik);
                    $('#ski_nama').val(data.nama);
                    $('#ski_nama_usaha').val(data.nama_usaha);
                    $('#ski_tempat_lahir').val(data.tempat_lahir);
                    $('#ski_tanggal_lahir').val(data.tanggal_lahir);
                    $('#ski_jenis_kelamin').val(data.jenis_kelamin);
                    $('#ski_pekerjaan').val(data.pekerjaan);
                    $('#ski_status_perkawinan').val(data.status_perkawinan);
                    $('#ski_agama').val(data.agama);
                    $('#ski_kecamatan').val(data.kecamatan);
                    $('#ski_kelurahan').val(data.kelurahan);
                    $('#ski_rt_rw').val(data.rt_rw);
                    $('#ski_alamat').val(data.alamat);
                    
                    $('#ktp').attr('src', '{{ asset('storage') }}/'+data.foto_ktp);
                    $('#kk').attr('src', '{{ asset('storage') }}/'+data.foto_kk);
                    $('#skt_rt_rw').attr('src', '{{ asset('storage') }}/'+data.foto_surat_rt_rw);
                }
            });
        }

</script>
@endpush