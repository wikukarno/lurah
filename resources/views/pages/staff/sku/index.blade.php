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
                        <div class="table-responsive">
                            <table id="tb_sku_staff" class="table table-hover scroll-horizontal-vertical w-100">
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

@include('pages.staff.sku.modal-tolak-sku')
@include('pages.staff.sku.modal-lampiran-sku')
@endsection

@push('after-scripts')
<script>
    $('#tb_sku_staff').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('sku-staff.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'nama', name: 'nama' },
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
                text: "Surat Keterangan Usaha anda telah selesai diproses, silahkan ambil surat anda di kantor desa",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke'
            })
        }

        function tolakSKU(id){
        $('#tolakSkuModal').modal('show');
        $('#id-sku').val(id);
        }

        $('#form-tolak-sku').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/staff/sku/tolak-sku') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $('#tolakSkuModal').modal('hide');
        $('#tb_sku_staff').DataTable().ajax.reload();
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

        function lampiranSku(id){
            $('#lampiranSkuModal').modal('show');
                $.ajax({
                type:'POST',
                url: "{{ url('pages/dashboard/staff/sku/get-lampiran') }}",
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

</script>
@endpush