@extends('layouts.dashboard')

@section('title')
Surat Ditolak
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Daftar Surat Ditolak</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_user_surat_ditolak_dashboard" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Diajukan</th>
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
@endsection

@push('after-scripts')
<script>
    $('#tb_user_surat_ditolak_dashboard').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ route('user.show-surat-ditolak-dashboard') }}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'user.nik', name: 'user.nik' },
            { data: 'nama', name: 'nama' },
            { data: 'id_kategori_surat', name: 'id_kategori_surat' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
    
    function skuSelesaiProses(){
        Swal.fire({
            title: 'Surat Selesai Diproses!',
            text: "Surat Keterangan Usaha Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        })
    }

    function skiSelesaiProses(){
        Swal.fire({
            title: 'Surat Selesai Diproses!',
            text: "Surat Keterangan Izin Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        })
    }

    function sktmSelesaiProses(){
        Swal.fire({
            title: 'Surat Selesai Diproses!',
            text: "Surat Keterangan Tidak Mampu Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        })
    }

    function skpSelesaiProses(){
        Swal.fire({
            title: 'Surat Selesai Diproses!',
            text: "Surat Keterangan Pemakaman Anda Telah Selesai Diproses, Silahkan Ambil Surat Anda Dikantor Lurah Sorek Satu Dengan Membawa Fotocopy KK, Fotocopy KTP, dan Surat Pengaturan RT/RW. Terima Kasih",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        })
    }

</script>
@endpush