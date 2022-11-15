<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
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
                    JL.DATUK LAKSAMANA NO. TELEPON <br>
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
        @php
        $year = date('Y');
        @endphp
        <div style="text-align: center;">
            <h1 style="font-size: 20px"><u>LAPORAN</u></h1>
        </div>

        <table style="margin-top: 30px" border="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Diajukan</th>
                    <th>Tanggal Disetujui</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $item)
                <tr>
                    <td style="padding: 10px">{{ $loop->iteration }}</td>
                    <td style="padding: 10px">{{ $item->no_nik }}</td>
                    <td style="padding: 10px">{{ $item->nama }}</td>
                    <td style="padding: 10px">{{ $item->jenis_surat }}</td>
                    <td style="padding: 10px">{{ $item->created_at->isoFormat('D MMMM Y') }}</td>
                    <td style="padding: 10px">{{ $item->updated_at->isoFormat('D MMMM Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </section>

    </div>
</body>

</html>