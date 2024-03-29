<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon" />
    <title>Lurah Sorek Satu</title>

    <!-- style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('home/style/main.css') }}" />

</head>

<body>
    <!-- Header -->
    <section class="section-content-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-ligt">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="/">
                                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#jadwal">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#informasi">Informasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                            href="https://api.whatsapp.com/send?phone=6282268777140&text=Assalamu'alaikum%20Pak,%20saya%20ingin%20bertanya%20?">Kontak</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo" style="max-height: 50px" />
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank"
                                href="https://api.whatsapp.com/send?phone=6282268777140&text=Assalamu'alaikum%20Pak,%20saya%20ingin%20bertanya%20?">Kontak</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    @auth
                    @if (Auth::user()->roles == 'Lurah')
                    <a href="{{ route('lurah.dashboard') }}" class="btn btn-success mx-2 mt-4">
                        Dashboard
                    </a>
                    @elseif (Auth::user()->roles == 'Staff')
                    <a href="{{ route('staff.dashboard') }}" class="btn btn-success mx-2 mt-4">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('user.dashboard') }}" class="btn btn-success mx-2 mt-4">
                        Dashboard
                    </a>
                    @endif
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-success mx-2 mt-4"> Masuk </a>
                    <a href="{{ route('register') }}" class="btn btn-primary mx-2 mt-4"> Daftar Sekarang </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <section class="section-hero-content text-center">
        <div class="overlay">
            <figure class="figure">
                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid figure-img w-50 h-50" alt="" />
            </figure>
            <h1 class="text-white">
                SELAMAT DATANG DI!
                <br />
                APLIKASI PELAYANAN SURAT MENYURAT <br />
                KANTOR LURAH SOREK SATU
            </h1>
            <p class="mt-3 text-white">
                Pengurusan surat menjadi mudah
                <br />
                tinggal klik surat langsung jadi.
            </p>

            <div class="d-flex justify-content-center">
                @auth
                @if (Auth::user()->roles == 'Lurah')
                <a href="{{ route('lurah.dashboard') }}" class="btn btn-success mx-2 mt-4">
                    Dashboard
                </a>
                @elseif (Auth::user()->roles == 'Staff')
                <a href="{{ route('staff.dashboard') }}" class="btn btn-success mx-2 mt-4">
                    Dashboard
                </a>
                @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-success mx-2 mt-4">
                    Dashboard
                </a>
                @endif
                @endauth
                @guest
                <a href="{{ route('login') }}" class="btn btn-success mx-2 mt-4"> Masuk </a>
                <a href="{{ route('register') }}" class="btn btn-success mx-2 mt-4"> Daftar </a>
                @endguest
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- Schedule -->
    <section class="section-schedule-content" id="jadwal">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3>WAKTU PELAYANAN</h3>
                    <div class="line-mf"></div>
                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col-12 col-md-6 d-none d-md-block">
                    <div class="d-flex img-clock-date" style="padding-top: 50px">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('home/images/clock-date.png') }}" class="img-fluid" alt="clock-date"
                                style="padding-left: 150px" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-bold">Senin - Jum'at</h5>
                            <p>08.00 - 16.00 WIB</p>
                        </div>
                    </div>
                    <div class="d-flex img-clock-date pt-5">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('home/images/clock-date.png') }}" class="img-fluid" alt="clock-date"
                                style="padding-left: 150px" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-bold">Sabtu - Minggu</h5>
                            <b class="text-danger">Tutup</b>
                        </div>
                    </div>
                </div>

                <div class="col-6 d-block d-md-none d-lg-none d-xl-none">
                    <div class="schedule-mobile">
                        <figure class="figure">
                            <img src="{{ asset('home/images/clock-date.png') }}" class="img-fluid figure-img"
                                alt="clock-date" style="max-height: 60px" />
                            <figcaption class="figure-caption">
                                <h5 class="fw-bold">Senin - Jum'at</h5>
                                <p>08.00 - 16.00 WIB</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-6 d-block d-md-none d-lg-none d-xl-none">
                    <div class="schedule-mobile">
                        <figure class="figure">
                            <img src="{{ asset('home/images/clock-date.png') }}" class="img-fluid figure-img"
                                alt="clock-date" style="max-height: 60px" />
                            <figcaption class="figure-caption">
                                <h5 class="fw-bold">Sabtu - Minggu</h5>
                                <b class="text-danger">Tutup</b>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center d-none d-md-block">
                    <figure class="figure" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('home/images/schedule.svg') }}" class="w-100" alt="" />
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End Schedule -->

    <!-- Procedure -->
    <section class="section-procedure-content" id="informasi">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3>PROSEDUR PERMOHONAN SURAT</h3>
                    <div class="line-mf"></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-md-6">
                    <div class="card" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('home/images/1.png') }}" class="img-fluid" alt="..." />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>Masuk / Daftar</h5>
                                    Pemohon harus masuk kedalam sistem terlebih dahulu
                                    menggunakan email dan kata sandi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('home/images/2.png') }}" class="img-fluid" alt="..." />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>Menginput Data</h5>
                                    Input data permohonan dengan sebelumnya melakukan login
                                    dengan email dan kata sandi yang telah didaftarkan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('home/images/3.png') }}" class="img-fluid" alt="..." />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>Mengajukan Surat Permohonan</h5>
                                    Pilih surat yang akan diajukan dan isi data yang diminta,
                                    klik ajukan surat untuk mengirim surat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card card-four" data-aos="fade-up" data-aos-delay="500">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('home/images/4.png') }}" class="img-fluid" alt="..." />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>Permohonan Disetujui</h5>
                                    Setelah permohonan disetujui, pemohon silahkan ambil surat
                                    yang telah diajukan di kantor desa dengan membawa surat
                                    pengantar RT/ RW, FC KTP dan KK.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Procedure -->

    <section class="section-location-content mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3>LOKASI KANTOR</h3>
                    <div class="line-mf"></div>
                </div>
            </div>
        </div>
        <div class="maps pt-5 pb-1">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8085114613705!2d102.0664005!3d0.1270489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5fd5e3a392ac5%3A0x9ed4d5d58bdefd93!2sKANTOR%20LURAH%20SOREK%20SATU!5e0!3m2!1sid!2sid!4v1667880545272!5m2!1sid!2sid"
                style="height: 400px; border: 0; width: 100%" allowfullscreen=""
                referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
    </section>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="{{ asset('home/aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>