<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\User;
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

        $tgl_cetak = date('d-M-Y');
        // return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Surat_Keterangan_Usaha_' . $user->name .  '.pdf');
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

        $tgl_cetak = date('d-M-Y');
        // return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Surat_Keterangan_Pemakaman_' . $user->name .  '.pdf');
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

        $tgl_cetak = date('d-M-Y');
        // return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Surat_Keterangan_Tidak_Mampu_' . $user->name .  '.pdf');
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

        $tgl_cetak = date('d-M-Y');
        // return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Surat_Izin_keramaian_' . $user->name .  '.pdf');
    }


    public function downloadLaporan(Request $request)
    {
        $path = base_path('public/assets/images/logo.png'); // local
        // $path = asset('assets/images/uir.png'); // production
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic  = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $laporan = Letter::with(['user'])->get();
        $pdf  = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.laporan', [
            'pic' => $pic,
            'laporans' => $laporan,
        ]);

        $tgl_cetak = date('d-M-Y');
        // return $pdf->download('Surat_Keterangan_Usaha_' . $user->name . '_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Laporan.pdf');
    }
}
