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
        <div class="title-surat">
            <h1><u>LAPORAN BULAN {{ getMonth($getMonth) }} TAHUN {{ $getYear }} </u></h1>
        </div>

        <table class="table-content" border="1">
            <thead>
                <tr>
                    <th style="padding: 10px; text-align:center; position: fixed">No.</th>
                    <th style="padding: 10px; text-align:center; position: fixed">NIK</th>
                    <th style="padding: 10px; text-align:center; position: fixed">Nama</th>
                    <th style="padding: 10px; text-align:center; position: fixed">Jenis Surat</th>
                    <th style="padding: 10px; text-align:center; position: fixed">Tanggal Diajukan</th>
                    <th style="padding: 10px; text-align:center; position: fixed">Tanggal Disetujui</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td style="padding: 10px; text-align:center">{{ $loop->iteration }}</td>
                    <td style="padding: 10px; text-align:center">{{ $item->no_nik }}</td>
                    <td style="padding: 10px; text-align:center">{{ $item->nama }}</td>
                    <td style="padding: 10px; text-align:center">{{ $item->jenis_surat }}</td>
                    <td style="padding: 10px; text-align:center">{{ $item->created_at->isoFormat('D/' . 'M/' . 'Y') }}
                    </td>
                    <td style="padding: 10px; text-align:center">{{ $item->updated_at->isoFormat('D/' . 'M/' . 'Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </section>

    </div>
</body>

</html>

<style>
    .title-surat h1 {
        font-family: sans-serif;
        font-size: 18px;
        text-align: center;
        color: #000;
        text-transform: uppercase;

    }

    .table-content {
        font-family: sans-serif;
        font-size: 12px;
        margin-top: 30px;
    }
</style>