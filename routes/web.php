<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lurah\DashboardLurahController;
use App\Http\Controllers\Lurah\LurahBusinessCertificationController;
use App\Http\Controllers\Lurah\LurahFuneralCertificationController;
use App\Http\Controllers\Lurah\LurahIncapacityCertificationController;
use App\Http\Controllers\Lurah\LurahPermitsController;
use App\Http\Controllers\Lurah\ProfileLurahController;
use App\Http\Controllers\Lurah\SkiLurahController;
use App\Http\Controllers\Lurah\SkpLurahController;
use App\Http\Controllers\Lurah\SktmLurahController;
use App\Http\Controllers\Lurah\SkuLurahController;
use App\Http\Controllers\Staff\DashboardStaffController;
use App\Http\Controllers\Staff\KategoriSuratController;
use App\Http\Controllers\Staff\ProfileStaffController;
use App\Http\Controllers\Staff\SkiStaffController;
use App\Http\Controllers\Staff\SkpStaffController;
use App\Http\Controllers\Staff\SktmStaffController;
use App\Http\Controllers\Staff\SkuStaffController;
use App\Http\Controllers\Staff\StaffBusinessCertificationController;
use App\Http\Controllers\Staff\StaffFuneralCertificationController;
use App\Http\Controllers\Staff\StaffIncapacityCertificationController;
use App\Http\Controllers\Staff\StaffPermitsController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\SkiUserController;
use App\Http\Controllers\User\SkpUserController;
use App\Http\Controllers\User\SktmUserController;
use App\Http\Controllers\User\SkuUserController;
use App\Http\Controllers\User\UserBusinessCertificationController;
use App\Http\Controllers\User\UserFuneralCertificationController;
use App\Http\Controllers\User\UserIncapacityCertificationController;
use App\Http\Controllers\User\UserPermitsController;
use App\Models\BusinessCertifications;
use App\Models\FuneralCertifications;
use App\Models\Permits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Dashboard
Route::prefix('/pages/dashboard/lurah')
    ->middleware(['auth', 'lurah'])
    ->group(function () {
        Route::get('/', [DashboardLurahController::class, 'index'])->name('lurah.dashboard');

        Route::get('/sku-lurah/diproses', [LurahBusinessCertificationController::class, 'onProgress'])->name('sku-lurah.onProgress');
        Route::get('/sku-lurah/selesai', [LurahBusinessCertificationController::class, 'success'])->name('sku-lurah.success');
        Route::get('/sku-lurah/ditolak', [LurahBusinessCertificationController::class, 'rejected'])->name('sku-lurah.rejected');

        Route::get('/skp-lurah/diproses', [LurahFuneralCertificationController::class, 'onProgress'])->name('skp-lurah.onProgress');
        Route::get('/skp-lurah/selesai', [LurahFuneralCertificationController::class, 'success'])->name('skp-lurah.success');
        Route::get('/skp-lurah/ditolak', [LurahFuneralCertificationController::class, 'rejected'])->name('skp-lurah.rejected');

        Route::get('/sktm-lurah/diproses', [LurahIncapacityCertificationController::class, 'onProgress'])->name('sktm-lurah.onProgress');
        Route::get('/sktm-lurah/selesai', [LurahIncapacityCertificationController::class, 'success'])->name('sktm-lurah.success');
        Route::get('/sktm-lurah/ditolak', [LurahIncapacityCertificationController::class, 'rejected'])->name('sktm-lurah.rejected');

        Route::get('/ski-lurah/diproses', [LurahPermitsController::class, 'onProgress'])->name('ski-lurah.onProgress');
        Route::get('/ski-lurah/selesai', [LurahPermitsController::class, 'success'])->name('ski-lurah.success');
        Route::get('/ski-lurah/ditolak', [LurahPermitsController::class, 'rejected'])->name('ski-lurah.rejected');

        Route::get('/sku/cetak/{id}', [CetakController::class, 'cetak_sku'])->name('sku-lurah.cetak-sku');
        Route::get('/skp/cetak/{id}', [CetakController::class, 'cetak_skp'])->name('skp-lurah.cetak-skp');
        Route::get('/sktm/cetak/{id}', [CetakController::class, 'cetak_sktm'])->name('sktm-lurah.cetak-sktm');
        Route::get('/ski/cetak/{id}', [CetakController::class, 'cetak_ski'])->name('ski-lurah.cetak-ski');

        // Route get lampiran
        // Route::post('/sku/get-lampiran', [SkuLurahController::class, 'show'])->name('sku-lurah.show');
        // Route::post('/skp/get-lampiran', [SkpLurahController::class, 'show'])->name('skp-lurah.show');
        // Route::post('/sktm/get-lampiran', [SktmLurahController::class, 'show'])->name('sktm-lurah.show');
        // Route::post('/ski/get-lampiran', [SkiLurahController::class, 'show'])->name('ski-lurah.show');

        // Route get akun, edit akun, ubah foto
        Route::post('/get-akun', [ProfileLurahController::class, 'show'])->name('lurah.get-akun');
        Route::post('/akun/update', [ProfileLurahController::class, 'update'])->name('lurah.update-akun');
        Route::post('/ubah-foto', [ProfileLurahController::class, 'ubahFoto'])->name('lurah.ubah-foto');

        // Route get penduduk
        Route::get('/penduduk', [DashboardLurahController::class, 'getPenduduk'])->name('lurah.penduduk');

        // filter laporan
        Route::post('/laporan-bulanan', [DashboardLurahController::class, 'filterLaporanBulanan'])->name('lurah.filter-laporan-bulanan');
        Route::post('/laporan-tahunan', [DashboardLurahController::class, 'filterLaporanTahunan'])->name('lurah.filter-laporan-tahunan');
        Route::post('/laporan-bulanan-tahunan', [DashboardLurahController::class, 'filterLaporanbulananTahunan'])->name('lurah.filter-laporan-bulanan-tahunan');

        // cetak laporan
        Route::get('/laporan', [DashboardLurahController::class, 'getLaporan'])->name('lurah.laporan');
        Route::get('/cetak-laporan-bulanan/{month}/{year}', [CetakController::class, 'downloadLaporanBulanan'])->name('cetak.laporan-bulanan');
        Route::get('/cetak-laporan-tahunan/{year}', [CetakController::class, 'downloadLaporanTahunan'])->name('cetak.laporan-tahunan');

        // Route get month
        Route::post('/month', [DashboardLurahController::class, 'showMonth'])->name('lurah.get-month');

        // Route::post('/sku/show/tolak-sku', [LurahBusinessCertificationController::class, 'showTolakSku'])->name('sku-lurah.show-tolak-sku');
        // Route::post('/skp/show/tolak-skp', [LurahFuneralCertificationController::class, 'showTolakSkp'])->name('skp-lurah.show-tolak-skp');
        // Route::post('/sktm/show/tolak-sktm', [LurahIncapacityCertificationController::class, 'showTolakSktm'])->name('sktm-lurah.show-tolak-sktm');
        // Route::post('/ski/show/tolak-ski', [LurahPermitsController::class, 'showTolakSki'])->name('ski-staff.show-tolak-ski');

        Route::post('/sku/setujui', [LurahBusinessCertificationController::class, 'setujui'])->name('sku-lurah.setujui');
        Route::post('/skp/setujui', [LurahFuneralCertificationController::class, 'setujui'])->name('skp-lurah.setujui');
        Route::post('/sktm/setujui', [LurahIncapacityCertificationController::class, 'setujui'])->name('sktm-lurah.setujui');
        Route::post('/ski/setujui', [LurahPermitsController::class, 'setujui'])->name('ski-lurah.setujui');

        // Tampilkan semua surat pada dashboard
        Route::get('/surat-keterangan-usaha', [LurahBusinessCertificationController::class, 'showSkuLurahDashboard'])->name('sku-lurah.show-sku-dashboard');
        Route::get('/surat-keterangan-izin', [LurahPermitsController::class, 'showSkiLurahDashboard'])->name('ski-lurah.show-ski-dashboard');
        Route::get('/surat-keterangan-tidak-mampu', [LurahIncapacityCertificationController::class, 'showSktmLurahDashboard'])->name('sktm-lurah.show-sktm-dashboard');
        Route::get('/surat-keterangan-pemakaman', [LurahFuneralCertificationController::class, 'showSkpLurahDashboard'])->name('skp-lurah.show-skp-dashboard');
        Route::get('/surat', [DashboardLurahController::class, 'allSurat'])->name('lurah.all-surat');

        Route::resource('sku-lurah', LurahBusinessCertificationController::class);
        Route::resource('skp-lurah', LurahFuneralCertificationController::class);
        Route::resource('sktm-lurah', LurahIncapacityCertificationController::class);
        Route::resource('ski-lurah', LurahPermitsController::class);
        Route::resource('akun-lurah', ProfileLurahController::class);
    });

// Route Staff
Route::prefix('/pages/dashboard/staff')
    ->middleware(['auth', 'staff'])
    ->group(function () {
        Route::get('/', [DashboardStaffController::class, 'index'])->name('staff.dashboard');

        // Route get lampiran sku
        Route::get('/sku/cetak/{id}', [CetakController::class, 'cetak_sku'])->name('sku-staff.cetak-sku');
        // Route::post('/sku/get-lampiran', [StaffBusinessCertificationController::class, 'show'])->name('sku-staff.show');
        Route::post('/sku/get-detail-users', [StaffBusinessCertificationController::class, 'showDetails'])->name('sku-staff.showDetails');
        Route::post('/sku/tolak-sku', [StaffBusinessCertificationController::class, 'tolakSku'])->name('sku-staff.tolak');
        Route::post('/sku/show/tolak-sku', [StaffBusinessCertificationController::class, 'showTolakSku'])->name('sku-staff.show-tolak-sku');
        Route::get('/sku-staff/diproses', [StaffBusinessCertificationController::class, 'onProgress'])->name('sku-staff.onProgress');
        Route::get('/sku-staff/selesai', [StaffBusinessCertificationController::class, 'success'])->name('sku-staff.success');
        Route::get('/sku-staff/ditolak', [StaffBusinessCertificationController::class, 'rejected'])->name('sku-staff.rejected');

        // Route get lampiran skp
        Route::get('/skp/cetak/{id}', [CetakController::class, 'cetak_skp'])->name('skp-staff.cetak-skp');
        // Route::post('/skp/get-lampiran', [SkpStaffController::class, 'show'])->name('skp-staff.show');
        Route::post('/skp/show/tolak-skp', [StaffFuneralCertificationController::class, 'showTolakSkp'])->name('skp-staff.show-tolak-skp');
        Route::post('/skp/tolak-skp', [StaffFuneralCertificationController::class, 'tolakSkp'])->name('skp-staff.tolak');
        Route::get('/skp-staff/diproses', [StaffFuneralCertificationController::class, 'onProgress'])->name('skp-staff.onProgress');
        Route::get('/skp-staff/selesai', [StaffFuneralCertificationController::class, 'success'])->name('skp-staff.success');
        Route::get('/skp-staff/ditolak', [StaffFuneralCertificationController::class, 'rejected'])->name('skp-staff.rejected');

        // Route get lampiran sktm
        Route::get('/sktm/cetak/{id}', [CetakController::class, 'cetak_sktm'])->name('sktm-staff.cetak-sktm');
        // Route::post('/sktm/get-lampiran', [StaffIncapacityCertificationController::class, 'show'])->name('sktm-staff.show');
        Route::post('/sktm/show/tolak-sktm', [StaffIncapacityCertificationController::class, 'showTolakSktm'])->name('sktm-staff.show-tolak-sktm');
        Route::post('/sktm/tolak-sktm', [StaffIncapacityCertificationController::class, 'tolakSktm'])->name('sktm-staff.tolak');
        Route::get('/sktm-staff/diproses', [StaffIncapacityCertificationController::class, 'onProgress'])->name('sktm-staff.onProgress');
        Route::get('/sktm-staff/selesai', [StaffIncapacityCertificationController::class, 'success'])->name('sktm-staff.success');
        Route::get('/sktm-staff/ditolak', [StaffIncapacityCertificationController::class, 'rejected'])->name('sktm-staff.rejected');

        // Route get lampiran ski
        Route::get('/ski/cetak/{id}', [CetakController::class, 'cetak_ski'])->name('ski-staff.cetak-ski');
        // Route::post('/ski/get-lampiran', [SkiStaffController::class, 'show'])->name('ski-staff.show');
        // Route::post('/ski/show/tolak-ski', [StaffPermitsController::class, 'showTolakSki'])->name('ski-staff.show-tolak-ski');
        Route::post('/ski/tolak-ski', [StaffPermitsController::class, 'tolakSki'])->name('ski-staff.tolak');
        Route::get('/ski-staff/diproses', [StaffPermitsController::class, 'onProgress'])->name('ski-staff.onProgress');
        Route::get('/ski-staff/selesai', [StaffPermitsController::class, 'success'])->name('ski-staff.success');
        Route::get('/ski-staff/ditolak', [StaffPermitsController::class, 'rejected'])->name('ski-staff.rejected');

        // Route get akun, edit akun, ubah foto
        Route::post('/get-akun', [ProfileStaffController::class, 'show'])->name('staff.get-akun');
        Route::post('/akun/update', [ProfileStaffController::class, 'update'])->name('staff.update-akun');
        Route::post('/ubah-foto', [ProfileStaffController::class, 'ubahFoto'])->name('staff.ubah-foto');


        // Route get penduduk
        Route::get('/penduduk', [DashboardStaffController::class, 'getPenduduk'])->name('staff.penduduk');
        Route::get('/verifikasi-penduduk', [DashboardStaffController::class, 'verifikasiPenduduk'])->name('staff.verifikasi-penduduk');
        Route::get('/verifikasi-penduduk/detail/{id}', [DashboardStaffController::class, 'detailVerifikasi'])->name('staff.detail-verifikasi');
        Route::post('/verifikasi-penduduk/verifikasi', [DashboardStaffController::class, 'verifikasi'])->name('staff.verifikasi');
        Route::get('/verifikasi-penduduk/tolak/{id}', [DashboardStaffController::class, 'getTolak'])->name('staff.get-tolak');
        Route::post('/verifikasi-penduduk/tolak/verifikasi/{id}', [DashboardStaffController::class, 'tolakVerifikasi'])->name('staff.tolak-verifikasi');

        Route::get('/sktm-staff/tolak/{id}', [StaffIncapacityCertificationController::class, 'getTolakSktm'])->name('staff.get-tolak-sktm');
        Route::post('/sktm-staff/tolak/{id}/tolak', [StaffIncapacityCertificationController::class, 'tolakSktm'])->name('staff.tolak-sktm');

        Route::get('/skp-staff/tolak/{id}', [StaffFuneralCertificationController::class, 'getTolakSkp'])->name('staff.get-tolak-skp');
        Route::post('/skp-staff/tolak/{id}/tolak', [StaffFuneralCertificationController::class, 'tolakSkp'])->name('staff.tolak-skp');

        Route::get('/ski-staff/tolak/{id}', [StaffPermitsController::class, 'getTolakSki'])->name('staff.get-tolak-ski');
        Route::post('/ski-staff/tolak/{id}/tolak', [StaffPermitsController::class, 'tolakSki'])->name('staff.tolak-ski');

        Route::get('/sku-staff/tolak/{id}', [StaffBusinessCertificationController::class, 'getTolakSku'])->name('staff.get-tolak-sku');
        Route::post('/sku-staff/tolak/{id}/tolak', [StaffBusinessCertificationController::class, 'tolakSku'])->name('staff.tolak-sku');

        // Tampilkan semua surat pada dashboard
        Route::get('/surat-keterangan-usaha', [StaffBusinessCertificationController::class, 'showSkuStaffDashboard'])->name('sku-staff.show-sku-dashboard');
        Route::get('/surat-keterangan-izin', [StaffPermitsController::class, 'showSkiStaffDashboard'])->name('ski-staff.show-ski-dashboard');
        Route::get('/surat-keterangan-tidak-mampu', [StaffIncapacityCertificationController::class, 'showSktmStaffDashboard'])->name('sktm-staff.show-sktm-dashboard');
        Route::get('/surat-keterangan-pemakaman', [StaffFuneralCertificationController::class, 'showSkpStaffDashboard'])->name('skp-staff.show-skp-dashboard');
        Route::get('/surat', [DashboardStaffController::class, 'allSurat'])->name('staff.all-surat');

        // Route Resource
        Route::resource('sku-staff', StaffBusinessCertificationController::class);
        Route::resource('skp-staff', StaffFuneralCertificationController::class);
        Route::resource('sktm-staff', StaffIncapacityCertificationController::class);
        Route::resource('ski-staff', StaffPermitsController::class);
        Route::resource('akun-staff', ProfileStaffController::class);
        Route::resource('kategori-surat', KategoriSuratController::class);
    });

// Route User
Route::prefix('/pages/dashboard/user')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('user.dashboard');
        Route::get('/lengkapi-data', [ProfileUserController::class, 'completeProfile'])->name('complete-profile');

        Route::get('/sku-user/diproses', [UserBusinessCertificationController::class, 'onProgress'])->name('sku-user.onProgress');
        Route::get('/sku-user/selesai', [UserBusinessCertificationController::class, 'success'])->name('sku-user.success');
        Route::get('/sku-user/ditolak', [UserBusinessCertificationController::class, 'rejected'])->name('sku-user.rejected');

        Route::post('/sku-user/delete', [UserBusinessCertificationController::class, 'destroy'])->name('sku-user.hapus');
        Route::post('/ski-user/delete', [UserPermitsController::class, 'destroy'])->name('ski-user.hapus');
        Route::post('/skp-user/delete', [UserFuneralCertificationController::class, 'destroy'])->name('skp-user.hapus');
        Route::post('/sktm-user/delete', [UserIncapacityCertificationController::class, 'destroy'])->name('sktm-user.hapus');

        Route::get('/skp-user/diproses', [UserFuneralCertificationController::class, 'onProgress'])->name('skp-user.onProgress');
        Route::get('/skp-user/selesai', [UserFuneralCertificationController::class, 'success'])->name('skp-user.success');
        Route::get('/skp-user/ditolak', [UserFuneralCertificationController::class, 'rejected'])->name('skp-user.rejected');

        Route::get('/sktm-user/diproses', [UserIncapacityCertificationController::class, 'onProgress'])->name('sktm-user.onProgress');
        Route::get('/sktm-user/selesai', [UserIncapacityCertificationController::class, 'success'])->name('sktm-user.success');
        Route::get('/sktm-user/ditolak', [UserIncapacityCertificationController::class, 'rejected'])->name('sktm-user.rejected');

        Route::get('/ski-user/diproses', [UserPermitsController::class, 'onProgress'])->name('ski-user.onProgress');
        Route::get('/ski-user/selesai', [UserPermitsController::class, 'success'])->name('ski-user.success');
        Route::get('/ski-user/ditolak', [UserPermitsController::class, 'rejected'])->name('ski-user.rejected');

        Route::get('/sku/cetak/{id}', [CetakController::class, 'cetak_sku'])->name('sku-user.cetak-sku');
        Route::get('/skp/cetak/{id}', [CetakController::class, 'cetak_skp'])->name('skp-user.cetak-skp');
        Route::get('/sktm/cetak/{id}', [CetakController::class, 'cetak_sktm'])->name('sktm-user.cetak-sktm');
        Route::get('/ski/cetak/{id}', [CetakController::class, 'cetak_ski'])->name('ski-user.cetak-ski');

        // Route get akun, edit akun, ubah foto dan get penolakan
        Route::post('/get-akun', [ProfileUserController::class, 'show'])->name('user.get-akun');
        Route::post('/akun/update', [ProfileUserController::class, 'update'])->name('user.update-akun');
        Route::post('/ubah-foto', [ProfileUserController::class, 'ubahFoto'])->name('user.ubah-foto');
        Route::post('/penolakan/sktm', [DashboardUserController::class, 'getPenolakanSktm'])->name('get-penolakan-sktm');
        Route::post('/penolakan/sku', [DashboardUserController::class, 'getPenolakanSku'])->name('get-penolakan-sku');
        Route::post('/penolakan/ski', [DashboardUserController::class, 'getPenolakanSki'])->name('get-penolakan-ski');
        Route::post('/penolakan/skp', [DashboardUserController::class, 'getPenolakanSkp'])->name('get-penolakan-skp');
        Route::post('/sku/show/tolak-sku', [UserBusinessCertificationController::class, 'showTolakSku'])->name('sku-user.show-tolak-sku');


        // Tampilkan semua surat pada dashboard
        Route::get('/surat-keterangan-usaha', [UserBusinessCertificationController::class, 'showSkuDashboard'])->name('sku-user.show-sku-dashboard');
        Route::get('/surat-keterangan-izin', [UserPermitsController::class, 'showSkiDashboard'])->name('ski-user.show-ski-dashboard');
        Route::get('/surat-keterangan-tidak-mampu', [UserIncapacityCertificationController::class, 'showSktmDashboard'])->name('sktm-user.show-sktm-dashboard');
        Route::get('/surat-keterangan-pemakaman', [UserFuneralCertificationController::class, 'showSkpDashboard'])->name('skp-user.show-skp-dashboard');
        Route::get('/surat', [DashboardUserController::class, 'showSuratUserDashboard'])->name('user.show-surat-user-dashboard');
        Route::get('/surat-ditolak', [DashboardUserController::class, 'showSuratDitolakUserDashboard'])->name('user.show-surat-ditolak-dashboard');
        Route::get('/surat-diproses', [DashboardUserController::class, 'showSuratDiprosesUserDashboard'])->name('user.show-surat-diproses-dashboard');
        Route::get('/surat-selesai', [DashboardUserController::class, 'showSuratSelesaiDiprosesUserDashboard'])->name('user.show-surat-selesai-dashboard');

        // Route Resource
        Route::resource('sku-user', UserBusinessCertificationController::class);
        Route::resource('skp-user', UserFuneralCertificationController::class);
        Route::resource('sktm-user', UserIncapacityCertificationController::class);
        Route::resource('ski-user', UserPermitsController::class);
        Route::resource('akun-user', ProfileUserController::class);
    });


Auth::routes();
