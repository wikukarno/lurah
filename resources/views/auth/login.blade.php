@extends('layouts.login')

@section('content')
<div class="login-box">
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" class="w-25 h-25" alt="">
            </a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Masuk ke sistem untuk mengurus keperluan anda!</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Email" required autofocus required
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
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" autocomplete="current-password" required
                        oninvalid="this.setCustomValidity('Harap masukan kata sandi')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <label for="remember" class="d-flex">
                                <input class="form-check" type="checkbox" name="remember" id="remember" {{
                                    old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">Remember Me</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-block btn-success">
                        Masuk Sekarang
                    </button>
                    <p class="mb-1">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-success">Lupa password?</a>
                        @endif
                    </p>
                    <hr />
                    <p class="mb-0"> belum punya akun?
                        <a href="{{ route('register') }}" class="text-center text-success">Daftar sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection