@extends('layouts.dashboard')

@section('title')
Profile {{ Auth::user()->name }}
@endsection

@section('content')
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h3 class="card-title">Menu Profile</h3>
                            <a href="javascript:void(0)" class="btn btn-primary"
                                onclick="ubahProfile({{ Auth::user()->id }})">Ubah Profile</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-body">
                                <form action="{{ route('user.ubah-foto') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <div class="text-center thumbnail-image" onclick="updateImage()">
                                        @if (Auth::user()->avatar != null)

                                        <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                            class="figure-img img-fluid rounded-circle" alt="foto profile"
                                            id="foto-profile" style="max-height: 100px; background-size: cover" />

                                        <input type="file" name="avatar" id="update-image-user" style="display: none"
                                            onchange="form.submit()">

                                        @else

                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('assets/images/user.png') }}" alt="User profile picture">
                                        <input type="file" name="avatar" id="update-image-user" style="display: none"
                                            onchange="form.submit()">

                                        @endif
                                    </div>
                                </form>
                                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                                <p class="text-center">{{ Auth::user()->roles }} Desa Sorek</p>
                                <div class="table-profile">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>{{ Auth::user()->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ Auth::user()->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor HP</td>
                                                <td>{{ Auth::user()->phone ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>{{ Auth::user()->address ?? '-' }}</td>
                                            </tr>
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
@include('pages.user.modal-ubah-profile')
@endsection

@push('after-scripts')
<script>
    function updateImage() {
            document.getElementById('update-image-user').click();
        }

        function ubahProfile(id){
            $('#ubahProfileModal').modal('show');
            $.ajax({
                url: "{{ route('user.get-akun') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                }
            });
        }

        $('#form-ubah-profile-user').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ route('user.update-akun') }}",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    $('#ubahProfileModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diubah',
                    }).then((result) => {
                        location.reload();
                    });
                },
            });
            return false;
        });
</script>
@endpush

@push('after-styles')
<style>
    .thumbnail-image {
        cursor: pointer;
    }
</style>
@endpush