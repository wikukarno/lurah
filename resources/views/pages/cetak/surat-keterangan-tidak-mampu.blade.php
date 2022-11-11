<!DOCTYPE html>
<html>

<head>
    <title>Surat Keterangan Tidak Mampu</title>
</head>

<body style="margin-top: 30px;margin-bottom: 20px;margin-right: 20px;margin-left: 30px;">
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

    <section class="section-top" style="padding-top: -70px;text-align: justify">
        @php
        $year = date('Y');
        @endphp
        <div style="text-align: center;">
            <h1 style="font-size: 20px"><u>SURAT KETERANGAN TIDAK MAMPU</u></h1>
            <p style="margin-top: -10px; font-weight: 500;">Nomor : 400/ Kessos/ {{ $year }}/<span
                    style="margin-left: 20px">.-</span>
            </p>
        </div>

        {{-- <table>
            <tbody>
                <tr>
                    <td style="padding-left: 50px">
                        Lurah Sorek Satu Kecamatan Pangkalan Kuras Kabupaten Pelalawan, dengan ini
                    </td>
                </tr>
                <tr>
                    <td>
                        menerangkan :
                    </td>
                </tr>
            </tbody>
        </table> --}}
        <p style="line-height: 24px">
            <span style="padding-left: 50px">Lurah Sorek Satu Kecamatan Pangkalan Kuras Kabupaten Pelalawan, dengan
                ini</span> menerangkan :
        </p>

        <table style="padding-left: 50px; margin-top: 15px; line-height: 24px">
            @php
            // $ttl = \Carbon\Carbon::now()->isoFormat('D MMMM Y', strtotime($sktm->tanggal_lahir));
            $ttl = \Carbon\Carbon::parse($sktm->tanggal_lahir)->isoFormat('D MMMM Y');
            @endphp
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td style="text-transform: uppercase"><b>{{ $sktm->nama ?? '-' }}</b></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $sktm->jenis_kelamin ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tempat/ Tgl.Lahir</td>
                    <td>:</td>
                    <td>{{ $sktm->tempat_lahir ?? '-' }}, {{ $ttl ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $sktm->pekerjaan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $sktm->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <td>RT/RW</td>
                    <td>:</td>
                    <td>{{ $sktm->rt_rw ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>:</td>
                    <td>{{ $sktm->kelurahan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>{{ $sktm->kecamatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $sktm->agama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>{{ $sktm->status_perkawinan ?? '-' }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $sktm->no_nik ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <p style="line-height: 24px">
            <span style="padding-left: 50px; text-align: justify">Bahwa yang namanya tersebut di atas adalah benar
                penduduk
                Kelurahan Sorek Satu Kecamatan Pangkalan Kuras dan menurut sepengetahuan kami benar yang bersangkutan
                penghidupan keluarganya sehari-hari termasuk <b>KELUARGA TIDAK MAMPU / MISKIN.</b></span>
        </p>

        <table style="text-align: justify">
            <tbody>
                <tr>
                    <td style="padding-left: 50px;">
                        Surat keterangan ini dipergunakan untuk <b>{{ $sktm->tujuan_surat_tidak_mampu }}.</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="line-height: 24px">
            <span style="padding-left: 50px; text-align: justify">Demikianlah Surat Keterangan Tidak Mampu ini kami
                berikan pada yang bersangkutan, untuk dapat dipergunakan sebagaimana mestinya.</span>
        </p>

        <table style="padding-left: 350px;">
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
            <p style="padding-left: 20px; padding-top: 40px">
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