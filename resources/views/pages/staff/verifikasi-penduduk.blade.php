@extends('layouts.dashboard')

@section('title')
Verifikasi Pengguna
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_verifikasi_penduduk"
                                class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profile</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Tanggal Daftar</th>
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

@include('pages.staff.modal-tolak-verifikasi')
@endsection

@push('after-scripts')
<script>
    $('#tb_verifikasi_penduduk').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{{ route('staff.verifikasi-penduduk') }}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id_user' },
            { data: 'foto', name: 'foto' },
            { data: 'email', name: 'email' },
            { data: 'nama', name: 'nama' },
            { data: 'created_at', name: 'created_at' },
            { 
                data: 'action', 
                name: 'action',
                orderable: false,
                searchable: false, 
            },
        ],
    });

    function verifikasiPengguna(id){
        $.ajax({
            url: "{{ route('staff.verifikasi') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}",
            },
            success: function(response){
                if(response.status == 'success'){
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#tb_verifikasi_penduduk').DataTable().ajax.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

    function tolakVerifikasi(id){
        $('#tolakVerifikasiModal').modal('show');
    }

    $('#form-tolak-verifikasi').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ url('pages/dashboard/staff/verifikasi-penduduk/tolak') }}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#tolakVerifikasiModal').modal('hide');
                $('#tb_verifikasi_penduduk').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Akun Berhasil Ditolak!',
                    text: "Pengguna Telah Ditolak",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                })
            }
        });
    });
</script>
@endpush