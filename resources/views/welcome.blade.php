<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="/">
                                <img src="{{ asset('home/images/logo.png') }}" class="img-fluid" alt="Logo" />
                            </a>
                            <button class="menu d-lg-none" data-bs-toggle="offcanvas" id="btnCanvas"
                                data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"
                                aria-label="Main Menu">
                                <svg width="50" height="50" viewBox="0 0 100 100">
                                    <path class="line line1"
                                        d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                                    <path class="line line2" d="M 20,50 H 80" />
                                    <path class="line line3"
                                        d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                                </svg>
                            </button>
                            <div class="offcanvas offcanvas-end d-md-none" data-bs-scroll="true" tabindex="-1"
                                id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with
                                        scrolling</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        aria-label="Close" id="btnCloseCanvas"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav navbar-mb ms-auto mb-2 mb-lg-0">
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
                                            <a class="nav-link" href="#berita">Berita</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" target="_blank"
                                                href="https://api.whatsapp.com/send?phone=6282268777140&text=Assalamu'alaikum%20Pak,%20saya%20ingin%20bertanya%20?">Kontak</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                        <a class="nav-link" href="#berita">Berita</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Kontak</a>
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

    <!-- Hero -->
    <section class="section-hero-content text-center">
        <div class="overlay">
            <div class="before-title">
                <p>
                    Selamat Datang Di,
                </p>
            </div>
            <div class="title">
                <h1>
                    APLIKASI PELAYANAN & PENGURUSAN SURAT <br />
                    KANTOR LURAH TANJUNG SARI
                </h1>
            </div>
            <div class="subtitle">
                <p class="mt-3">
                    Pengurusan surat menjadi mudah
                    <br />
                    tinggal klik surat langsung jadi.
                </p>
            </div>

            <div class="container">
                <div class="row">
                    <div class="btn-hero d-flex justify-content-center">
                        @guest
                            <div class="col-3 col-lg-2 mx-3">
                                <div class="d-grid mb-2">
                                    <a href="{{ route('login') }}" class="btn btn-masuk btn-primary">Masuk</a>
                                </div>
                            </div>
                            <div class="col-3 col-lg-2 mx-3">
                                <div class="d-grid mb-2">
                                    <a href="{{ route('register') }}" class="btn btn-daftar btn-primary">Daftar</a>
                                </div>
                            </div>
                        @endguest
                        @auth
                            <div class="col-3 col-lg-2 mx-3">
                                <div class="d-grid mb-2">
                                    @if (Auth::user()->roles == 'Lurah')
                                        <a href="{{ route('lurah.dashboard') }}" class="btn btn-masuk btn-primary">Dashboard</a>
                                    @elseif (Auth::user()->roles == 'Staff')
                                        <a href="{{ route('staff.dashboard') }}" class="btn btn-masuk btn-primary">Dashboard</a>
                                    @else
                                        <a href="{{ route('user.dashboard') }}" class="btn btn-masuk btn-primary">Dashboard</a>
                                    @endif
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
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

    <!-- News -->
    <section class="section-news-content" id="berita">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3>BERITA TERBARU</h3>
                    <div class="line-mf"></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ asset('home/images/news-1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#">
                                <h5 class="card-title">Sosialisasi Kepengurusan Desa Tanjung Sari</h5>
                            </a>
                            <p class="card-text" id="card-text-1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard
                                dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                scrambled it to make a type specimen
                                book. It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially
                                unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of
                                Lorem Ipsum.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ asset('home/images/news-2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#">
                                <h5 class="card-title">Sosialisasi Kepengurusan Desa Tanjung Sari</h5>
                            </a>
                            <p class="card-text" id="card-text-2">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard
                                dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                scrambled it to make a type specimen
                                book. It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially
                                unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of
                                Lorem Ipsum.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ asset('home/images/news-3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="#">
                                <h5 class="card-title">Sosialisasi Kepengurusan Desa Tanjung Sari</h5>
                            </a>
                            <p class="card-text" id="card-text-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard
                                dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                scrambled it to make a type specimen
                                book. It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially
                                unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of
                                Lorem Ipsum.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End News -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="{{ asset('home/aos/aos.js') }}"></script>
    <script>
        AOS.init();
        
                var btnCanvas = document.getElementById('btnCanvas');
                var btnCloseCanvas = document.getElementById('btnCloseCanvas');
                var cardText1 = document.getElementById('card-text-1');
                var cardText2 = document.getElementById('card-text-2');
                var cardText3 = document.getElementById('card-text-3');

                if(cardText1.innerHTML.length > 100) {
                    cardText1.innerHTML = cardText1.innerHTML.substring(0, 100) + '...';
                }

                if(cardText2.innerHTML.length > 100) {
                    cardText2.innerHTML = cardText2.innerHTML.substring(0, 100) + '...';
                }

                if(cardText3.innerHTML.length > 100) {
                    cardText3.innerHTML = cardText3.innerHTML.substring(0, 100) + '...';
                }

                btnCanvas.addEventListener('click', function() {
                    btnCanvas.classList.add('opened');
                });

                btnCloseCanvas.addEventListener('click', function() {
                    btnCanvas.classList.remove('opened');
                });
        
    </script>
</body>

</html>