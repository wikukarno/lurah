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
                                <img src="{{ asset('home/images/logo.png') }}" class="img-fluid" alt="Logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a class="nav-link" href="#kontak">Kontak</a>
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
            <figure class="figure">
                <img src="{{ asset('home/images/logo.png') }}" class="img-fluid figure-img w-50 h-50" alt="" />
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
                <a href="{{ route('login') }}" class="btn btn-masuk mx-2 mt-4"> Masuk </a>
                <a href="{{ route('register') }}" class="btn btn-daftar mx-2 mt-4"> Daftar </a>
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
                    <figure class="figure">
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
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card card-four">
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
                src="https://maps.google.com/maps?q=Riau,%20jalan%20malin%20kuning,%20RT.5/RW.11,%20Sorek%20Satu,%20Kec.%20Pangkalan%20Kuras,%20Kabupaten%20Pelalawan,%20Riau%2028383&t=&z=15&ie=UTF8&iwloc=&output=embed"
                style="height: 400px; border: 0; width: 100%" allowfullscreen=""></iframe>
        </div>
    </section>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>