<?php

namespace App\Http\Controllers;

use App\Models\Letter;
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

        $sku = Letter::with(['user'])->where('id', $request->id)->first();
        $user = User::where('id', $sku->users_id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-usaha', [
            'title' => 'Surat Tugas',
            'pic' => $pic,
            'sku' => $sku,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
    }

    public function cetak_skp(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $skp = Letter::with(['user'])->where('id', $request->id)->first();
        $user = User::where('id', $skp->users_id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-pemakaman', [
            'title' => 'Surat Tugas',
            'pic' => $pic,
            'skp' => $skp,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Pemakaman_' . $user->name . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Pemakaman_' . $user->name . '_' . $tgl_cetak .  '.pdf');
    }

    public function cetak_sktm(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $sktm = Letter::with(['user'])->where('id', $request->id)->first();
        $user = User::where('id', $sktm->users_id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-keterangan-tidak-mampu', [
            'title' => 'Surat Tugas',
            'pic' => $pic,
            'sktm' => $sktm,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Keterangan_Tidak_Mampu_' . $user->name . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Keterangan_Tidak_Mampu_' . $user->name . '_' . $tgl_cetak . '.pdf');
    }

    public function cetak_ski(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $ski = Letter::with(['user'])->where('id', $request->id)->first();
        $user = User::where('id', $ski->users_id)->first();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-izin', [
            'pic' => $pic,
            'ski' => $ski,
            'user' => $user
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        return $pdf->download('Surat_Izin_' . $ski->nama_izin . '_' . $user->name . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Surat_Izin_keramaian_' . $user->name . '_' . $tgl_cetak .  '.pdf');
    }

    public function downloadLaporanBulanan(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $laporan = Letter::whereMonth('created_at', $request->month)->firstOrFail();
        // if data not found
        if (!$laporan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        } else {
            $items = Letter::whereMonth('created_at', $request->month)->whereYear('created_at', $request->year)->get();
        }
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.laporan-bulanan', [
            'pic' => $pic,
            'laporans' => $laporan,
            'items' => $items,
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        $getMonth = $request->month;
        $getYear = $request->year;
        return $pdf->download('Data_Laporan_Bulan_' . $getMonth . '_Tahun_' . $getYear . '_' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Laporan.pdf');
    }

    public function downloadLaporanTahunan(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $laporan = Letter::whereYear('created_at', $request->year)->first();
        $items = Letter::whereYear('created_at', $request->year)->get();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.laporan-tahunan', [
            'pic' => $pic,
            'laporans' => $laporan,
            'items' => $items,
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        $getYear = $request->year;
        return $pdf->download('Data_Laporan_' . $getYear . ' ' . $tgl_cetak . '.pdf');
        // return $pdf->stream('Laporan.pdf');
    }
}
