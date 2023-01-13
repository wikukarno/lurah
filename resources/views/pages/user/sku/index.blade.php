@extends('layouts.dashboard')

@section('title')
Surat Keterangan Usaha
@endsection

@section('content')
@if ($user->status_account == 'pending')
<section class="main-content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{ asset('assets/img/verifikasi.svg') }}" class="figure-img img-fluid" alt="">
                            <figcaption class="figure-caption mt-5">
                                <h3 class="text-center">Mohon Maaf!</h3>
                                <p class="text-center">Akun anda saat ini sedang diverifikasi oleh admin <br /> mohon
                                    untuk menunggu,
                                    Terimakasih</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@elseif (count($userDetails) > 0)
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Data Surat Keterangan Usaha</h3>
                            <a href="{{ route('sku-user.create') }}" class="btn btn-primary"> <i
                                    class="fas fa-plus"></i>&nbsp;
                                Tambah Surat</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_sku" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Usaha</th>
                                        <th>Jenis Usaha</th>
                                        <th>Posisi</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>File</th>
                                        <th>Status</th>
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
@else
<section class="main-content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{ asset('assets/img/data.svg') }}" class="figure-img img-fluid" alt="">
                            <figcaption class="figure-caption mt-5">
                                <h3 class="text-center">Data Anda Belum Lengkap</h3>
                                <p class="text-center">Silahkan Lengkapi Profile Anda Terlebih Dahulu</p>
                                <a href="{{ route('complete-profile') }}" class="btn btn-primary"> <i
                                        class="fas fa-plus"></i>&nbsp;
                                    Lengkapi Data</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('after-scripts')
<script>
    $('#tb_sku').DataTable({
            processing: true,
            serverSide: true,
            ordering: [[1, 'asc']],
            ajax: {
                url: "{{ route('sku-user.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'nama_usaha', name: 'nama_usaha' },
                { data: 'jenis_usaha', name: 'jenis_usaha' },
                { data: 'posisi', name: 'posisi' },
                { data: 'created_at', name: 'created_at' },
                { data: 'surat_rtrw', name: 'surat_rtrw' },
                { 
                    data: 'status', 
                    name: 'status', 
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

        function penolakan(id){
        $.ajax({
        type: "POST",
        url: "{{ route('sku-user.show-tolak-sku') }}",
        data: {
        id: id,
        _token: "{{ csrf_token() }}"
        },
        dataType: "JSON",
        success: function (response) {
        Swal.fire({
        title: 'Surat Ditolak!',
        text: "Keterangan Penolakan : " +response.alasan_penolakan,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
        });
        }
        });
        }

</script>
@endpush