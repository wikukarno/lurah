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
                    $('#no_nik').val(data.no_nik);
                    $('#nama').val(data.nama);
                    $('#nama_usaha').val(data.nama_usaha);
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
                    $('#tujuan_surat_tidak_mampu').val(data.tujuan_surat_tidak_mampu);
                    
                    $('#ktp').attr('src', '{{ asset('storage') }}/'+data.ktp);
                    $('#kk').attr('src', '{{ asset('storage') }}/'+data.kk);
                    $('#surat_rt_rw').attr('src', '{{ asset('storage') }}/'+data.surat_rt_rw);
                }
            });
        }

</script>
@endpush