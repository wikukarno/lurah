<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    @stack('before-styles')
    @include('includes.styles')
    @stack('after-styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.navbar')
            @include('includes.sidebar')
            @yield('content')
            @include('includes.footer')
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin keluar ?</div>
                <div class="modal-footer">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    @stack('before-scripts')
    @include('includes.scripts')
    <script>
        $('#nik').on('keyup', function() {
            var nik = $(this).val();
            if (nik.length > 16) {
                $(this).val(nik.substring(0, 16));
            }
        });

        $('#jumlah_peserta').on('keyup', function() {
            var jumlah_peserta = $(this).val();
            if (jumlah_peserta.length > 5) {
                $(this).val(jumlah_peserta.substring(0, 5));
            }
        });
    
        // make phone number 12 digit
        $('#phone').on('keyup', function() {
            var phone = $(this).val();
            if (phone.length > 12) {
                $(this).val(phone.substring(0, 12));
            }
        });
    </script>
    @stack('after-scripts')

</body>

</html>