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
                        <div class="table-responsive">
                            <table id="tb_sku" class="table table-hover scroll-horizontal-vertical w-100">
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
</section>
@include('pages.staff.skp.modal-lampiran-skp')
@endsection

@push('after-scripts')
<script>
    $('#tb_sku').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('skp-lurah.index') }}",
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

        function lampiranSkpLurah(id){
        $('#lampiranSkpModal').modal('show');
        $.ajax({
        type:'POST',
        url: "{{ url('pages/dashboard/lurah/skp/get-lampiran') }}",
        data: {
        id:id,
        _token: '{{csrf_token()}}'
        },
        success: (data) => {
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
        $('#hari_meninggal').val(data.hari_meninggal);
        $('#tanggal_meninggal').val(data.tanggal_meninggal);
        $('#nama_pemakaman').val(data.nama_pemakaman);
        $('#tanggal_dimakamkan').val(data.tanggal_dimakamkan);
        
        $('#ktp').attr('src', '{{ asset('storage') }}/'+data.ktp);
        $('#kk').attr('src', '{{ asset('storage') }}/'+data.kk);
        $('#surat_rt_rw').attr('src', '{{ asset('storage') }}/'+data.surat_rt_rw);
        }
        });
        }
</script>
@endpush