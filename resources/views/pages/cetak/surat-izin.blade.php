<!DOCTYPE html>
<html>

<head>
    <title>Surat Izin</title>
</head>

<body style="margin-top: 30px;margin-bottom: 20px; margin-right: 20px;margin-left: 30px;">
    <style>
        .title h1 {
            font-family: 'Times New Roman', sans-serif;
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
            padding-bottom: 5px;
            margin-left: -30px;
            text-align: center;
            color: #000;
        }

        .title h2 {
            font-family: 'Times New Roman', sans-serif;
            font-size: 20px;
            margin-top: -20px;
            margin-left: -15px;
            font-weight: bold;
            text-align: center;
            color: #000;
        }

        .title h3 {
            font-family: 'Times New Roman', sans-serif;
            font-size: 26px;
            margin-top: -20px;
            margin-left: -15px;
            font-weight: bold;
            text-align: center;
            color: #000;
        }

        img {
            margin-top: -30px !important;
            margin-left: -10px;
        }

        .subtitle {
            text-align: center;
            margin-top: -30px;
            padding-bottom: -530px !important;
            margin-left: -15px;
        }

        .code-pos {
            color: #000;
            font-size: 14px !important;
            padding-left: 470px;
        }

        .kop-border {
            border: 2px solid rgb(0, 0, 0);
            margin-top: -20px !important;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
    <table>
        <tr>
            <td class="logo" rowspan="2">
                <img src="{{ $pic }}" style="max-height: 95px" alt="">
            </td>
            <td class="title">
                <h1><b>PEMERINTAHAN KABUPATEN PELALAWAN</b></h1>
                <h2><b>KECAMATAN PANGKALAN KURAS</b></h2>
                <h3><b>KELURAHAN SOREK SATU</b></h3>
            </td>
        </tr>
        <tr>
            <td>
                <p class="subtitle">
                    JL. DATUK LAKSAMANA NO. TELEPON <br>
                    <span class="code-pos">KODE POS 28382</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr class="kop-border">
            </td>
        <tr>

    </table>

    <section class="section-top" style="margin: 30px; margin-top: -30px" style="text-align: justify">

        <table style="padding-left: 400px">
            <tbody>
                <tr>
                    <td>
                        Sorek Satu, {{ $tanggal = Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <table style="margin-top: 10px">
                        <tbody>
                            <tr>
                                <td>
                                    <span style="margin-left: 30px">Kepada</span> <br />
                                    Yth. <span style="text-transform: capitalize">{{ $ski->tujuan_surat }}</span>
                                    <br />
                                    di. - <br />
                                    <u><span style="margin-left: 30px">Sorek Satu</span></u>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
            </tbody>
        </table>
        <div class="header-keterangan" style="margin-top: -170px;">
            <p>
                <span>
                    Nomor <span style="padding-left: 25px">:</span> 435/ KS/ 2020/ <span
                        style="padding-left: 30px">.-</span>
                </span>
            </p>
            <p style="margin-top: -10px">
                <span>
                    Lampiran <span style="padding-left: 8px">:</span> -
                </span>
            </p>
            <p style="margin-top: -10px">
                <span>
                    Perihal <span style="padding-left: 25px">:</span> {{ $ski->perihal }}
                </span>
            </p>
        </div>
        <p style="padding-left: 80px; margin-top: -10px">
            <b><u>a.n. <span style="text-transform: uppercase">{{ $ski->user->name }}</span></u></b>
        </p>


        <p style="line-height: 24px">
            <span style="padding-left: 130px">Berdasarkan permohonan lisan yang disampaikan kepada kami pada</span>
            <span style="padding-left: 100px">Tanggal {{ $ski->created_at->isoFormat('D MMMM Y') }} oleh saudara
                :</span>
        </p>

        <table style="padding-left: 80px; width: 100%; margin-top: -20px">
            @php
            // $ttl = \Carbon\Carbon::now()->isoFormat('D MMMM Y', strtotime($ski->tanggal_lahir));
            // $ttl = date('d l Y', strtotime($ski->tanggal_lahir));
            $ttl = \Carbon\Carbon::parse($ski->user->tanggal_lahir)->isoFormat('D MMMM Y');
            @endphp
            <tbody>
                <p>
                    <span style="padding-left: 50px">Nama</span>
                    <span style="padding-left: 90px; padding-right: 10px">:</span>
                    <span style="text-transform: uppercase;"><b>{{ $ski->user->nama }}</b></span>
                </p>
                <p style="margin-top: -10px">
                    <span style="padding-left: 50px">Tempat, Tgl Lahir</span>
                    <span style="padding-left: 10px; padding-right: 10px">:</span>
                    <span>{{ $ski->user->tempat_lahir }}, {{ $ttl }}</span>
                </p>
                <p style="margin-top: -10px">
                    <span style="padding-left: 50px">Pekerjaan</span>
                    <span style="padding-left: 65px; padding-right: 10px">:</span>
                    <span>{{ $ski->user->pekerjaan }}</span>
                </p>
                <p style="margin-top: -10px">
                    <span style="padding-left: 50px">Alamat</span>
                    <span style="padding-left: 81px; padding-right: 10px">:</span>
                    <span>{{ $ski->user->alamat }}</span>
                </p>
                <p style="margin-top: -10px">
                    <span style="padding-left: 50px">NIK</span>
                    <span style="padding-left: 100px; padding-right: 10px">:</span>
                    <span>{{ $ski->user->nik }}</span>
                </p>

            </tbody>
        </table>

        <table style="padding-left: 100px;">
            <tbody>
                <tr>
                    <td>Adapun maksud dan tujuannya ingin mengadakan acara <b>"{{ $ski->nama_izin }}"</b> yang akan
                        di
                        laksanakan pada :</td>
                </tr>

                @php
                $hari = \Carbon\Carbon::parse($ski->tanggal_izin)->isoFormat('dddd');
                $tanggalAcara = \Carbon\Carbon::parse($ski->tanggal_izin)->isoFormat('D MMMM Y');
                $jamMulai = \Carbon\Carbon::parse($ski->waktu_izin)->isoFormat('HH:mm');
                @endphp
                <table>
                    <tbody>
                        <p>
                            <span style="padding-left: 30px">Hari/Tanggal</span>
                            <span style="padding-left: 44px; padding-right: 10px">:</span>
                            <span>{{ $hari }} / {{ $tanggalAcara }}</span>
                        </p>
                        <p style="margin-top: -10px">
                            <span style="padding-left: 30px">Pukul</span>
                            <span style="padding-left: 93px; padding-right: 10px">:</span>
                            <span>{{ 
                                \Carbon\Carbon::parse($ski->waktu_izin)->isoFormat('HH:mm') }} WIB</span>
                        </p>
                        <p style="margin-top: -10px">
                            <span style="padding-left: 30px">Tempat</span>
                            <span style="padding-left: 82px; padding-right: 10px">:</span>
                            <span>{{ $ski->tempat_izin }}</span>
                        </p>
                        <p style="margin-top: -10px">
                            <span style="padding-left: 30px">Jumlah Undangan</span>
                            <span style="padding-left: 15px; padding-right: 10px">:</span>
                            <span>{{ $ski->jumlah_peserta }}</span>
                        </p>
                        <p style="margin-top: -10px">
                            <span style="padding-left: 30px">Hiburan</span>
                            <span style="padding-left: 79px; padding-right: 10px">:</span>
                            <span>{{ $ski->hiburan }}</span>
                        </p>

                    </tbody>
                </table>
            </tbody>
        </table>

        <table style="padding-left: 100px; text-align: justify; margin-top: -20px">
            <tbody>
                <p>
                    <span style="padding-left: 30px">Sehubung dengan hal tersebut diatas pada prinsipnya kami tidak
                        berkeberatan</span>
                    memberikan izin tempat pada yang bersangkutan, namun untuk proses selanjutnya kami harapkan
                    kehadapan Bapak.
                </p>
            </tbody>
        </table>

        <table style="padding-left: 80px; text-align: justify">
            <tbody>
                <tr>
                    <td style="padding-left: 50px;">
                        Demikianlah untuk dimaklumi sebagaimana mestinya.
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="padding-left: 350px; margin-top: 10px">
            <tbody>
                <tr>
                    <td>Dikeluarkan</td>
                    <td>:</td>
                    <td>Sorek Satu</td>
                </tr>
                <tr>
                    <td>Pada Tanggal</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y'); }}</td>
                </tr>
            </tbody>
            <hr style="width: 210%" />
        </table>

        <div class="signature" style="padding-left: 395px">
            <p>
                LURAH SOREK SATU
            </p>
            <p style="padding-left: 20px; padding-top: 50px">
            </p>
            <u><b>EDI MARDIANTO. S.Pd</b></u>
            <br />
            NIP.19821230200801 1 013.-
            </p>
        </div>

    </section>

    </div>
</body>

</html>