@extends('layouts.register')

@section('title')
Daftar Akun
@endsection

@section('content')

<div class="register-box">
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" class="w-25 h-25" alt="">
            </a>
        </div>
        <div class="card-body">
            <h3 class="login-box-msg">Daftar akun baru</h3>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        value="{{ old('nama') }}" placeholder="Nama lengkap" required maxlength="30"
                        oninvalid="this.setCustomValidity('Harap masukan nama')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" name="email" placeholder="Alamat email" required maxlength="30"
                        oninvalid="this.setCustomValidity('Harap masukan email')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" maxlength="50"
                        placeholder="Kata sandi" required oninvalid="this.setCustomValidity('Harap masukan kata sandi')"
                        oninput="setCustomValidity('')" autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi kata sandi" required
                        oninvalid="this.setCustomValidity('Please Enter valid email')" autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </div>
                </div>
            </form>
            <div class="row text-center">
                <div class="col-12">
                    <a href="{{ route('login') }}" class="text-center text-success">Sudah punya akun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection