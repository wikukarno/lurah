<?php

namespace App\Http\Controllers;

use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\IncapacityCertifications;
use App\Models\Laporan;
use App\Models\Letter;
use App\Models\Permits;
use App\Models\SKI;
use App\Models\SKP;
use App\Models\SKTM;
use App\Models\SKU;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function cetak_sku(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $sku = SKU::with(['user'])->where('id', $request->id)->first();
        $user = User::with(['userDetails'])->where('id', $request->id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-usaha', [
            'pic' => $pic,
            'sku' => $sku,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Usaha_' . $sku->user->nama . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
    }

    public function cetak_skp(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $skp = SKP::with(['user'])->where('id', $request->id)->first();
        $user = User::with(['userDetails'])->where('id', $request->id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-pemakaman', [
            'pic' => $pic,
            'skp' => $skp,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Pemakaman_' . $skp->user->nama . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Pemakaman_' . $user->name . '_' . $tgl_cetak .  '.pdf');
    }

    public function cetak_sktm(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $sktm = SKTM::with(['user'])->where('id', $request->id)->first();
        $user = User::with(['userDetails'])->where('id', $request->id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-tidak-mampu', [
            'pic' => $pic,
            'sktm' => $sktm,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Tidak_Mampu_' . $sktm->user->name . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Tidak_Mampu_' . $user->name . '_' . $tgl_cetak . '.pdf');
    }

    public function cetak_ski(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $ski = SKI::with(['user'])->where('id', $request->id)->first();
        $user = User::where('id', $request->id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-izin', [
            'pic' => $pic,
            'ski' => $ski,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Izin_' . $ski->nama_izin . '_' . $ski->user->nama . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Izin_keramaian_' . $user->name . '_' . $tgl_cetak .  '.pdf');
    }

    public function downloadLaporanBulanan(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $laporan = Laporan::whereMonth('created_at', $request->month)->first();
        $items = Laporan::with('category')->whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->where('status', 'Selesai Diproses')->get();
        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        $getMonth = $request->month;
        $getYear = $request->year;
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.laporan-bulanan', [
            'pic' => $pic,
            'laporans' => $laporan,
            'items' => $items,
            'getMonth' => $getMonth,
            'getYear' => $getYear,
        ]);
        return $pdf->download('Data_Laporan_Bulan_' . $getMonth . '_Tahun_' . $getYear . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Laporan.pdf');
    }

    public function downloadLaporanTahunan(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $laporan = Laporan::whereYear('created_at', $request->year)->first();
        // $items = Laporan::whereYear('created_at', $request->year)->get();
        $items = Laporan::with('category', 'funeral')->whereYear('created_at', $request->year)->where('status', 'Selesai Diproses')->get();

        $getYear = $request->year;
        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.laporan-tahunan', [
            'pic' => $pic,
            'laporans' => $laporan,
            'items' => $items,
            'getYear' => $getYear,
        ]);

        return $pdf->download('Data_Laporan_' . $getYear . ' ' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Laporan.pdf');
    }
}
