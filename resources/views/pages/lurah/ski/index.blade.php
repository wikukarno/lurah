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

</script>
@endpush