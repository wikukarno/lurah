@extends('layouts.dashboard')

@section('title')
Surat Keterangan Tidak Mampu
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Keterangan Tidak Mampu</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_sktm_staff" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
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

@include('pages.staff.sktm.modal-tolak-sktm')
@include('pages.staff.sktm.modal-lampiran-sktm')
@endsection

@push('after-scripts')
<script>
    $('#tb_sktm_staff').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('sktm-staff.index') }}",
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
                text: "Surat Keterangan Usaha anda telah selesai diproses, silahkan ambil surat anda di kantor desa",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke'
            })
        }

        function tolakSKTM(id){
        $('#tolakSktmModal').modal('show');
        $('#id-sktm').val(id);
        }

        $('#form-tolak-sktm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/staff/sktm/tolak-sktm') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $('#tolakSktmModal').modal('hide');
        $('#tb_sktm_staff').DataTable().ajax.reload();
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

        function lampiranSktm(id){
            $('#lampiranSktmModal').modal('show');
                $.ajax({
                type:'POST',
                url: "{{ url('pages/dashboard/staff/sktm/get-lampiran') }}",
                data: {
                id:id,
                _token: '{{csrf_token()}}'
            },
                success: (data) => {
                    console.log(data);
                    $('#sktm_no_nik').val(data.no_nik);
                    $('#sktm_nama').val(data.nama);
                    $('#sktm_nama_usaha').val(data.nama_usaha);
                    $('#sktm_tempat_lahir').val(data.tempat_lahir);
                    $('#sktm_tanggal_lahir').val(data.tanggal_lahir);
                    $('#sktm_jenis_kelamin').val(data.jenis_kelamin);
                    $('#sktm_pekerjaan').val(data.pekerjaan);
                    $('#sktm_status_perkawinan').val(data.status_perkawinan);
                    $('#sktm_agama').val(data.agama);
                    $('#sktm_kecamatan').val(data.kecamatan);
                    $('#sktm_kelurahan').val(data.kelurahan);
                    $('#sktm_rt_rw').val(data.rt_rw);
                    $('#sktm_alamat').val(data.alamat);
                    
                    $('#ktp').attr('src', '{{ asset('storage') }}/'+data.foto_ktp);
                    $('#kk').attr('src', '{{ asset('storage') }}/'+data.foto_kk);
                    $('#skt_rt_rw').attr('src', '{{ asset('storage') }}/'+data.foto_surat_rt_rw);
                }
            });
        }

</script>
@endpush