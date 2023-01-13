<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lurah\DashboardLurahController;
use App\Http\Controllers\Lurah\LurahBusinessCertificationController;
use App\Http\Controllers\Lurah\ProfileLurahController;
use App\Http\Controllers\Lurah\SkiLurahController;
use App\Http\Controllers\Lurah\SkpLurahController;
use App\Http\Controllers\Lurah\SktmLurahController;
use App\Http\Controllers\Lurah\SkuLurahController;
use App\Http\Controllers\Staff\DashboardStaffController;
use App\Http\Controllers\Staff\ProfileStaffController;
use App\Http\Controllers\Staff\SkiStaffController;
use App\Http\Controllers\Staff\SkpStaffController;
use App\Http\Controllers\Staff\SktmStaffController;
use App\Http\Controllers\Staff\SkuStaffController;
use App\Http\Controllers\Staff\StaffBusinessCertificationController;
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

        // Route get lampiran
        Route::post('/sku/get-lampiran', [SkuLurahController::class, 'show'])->name('sku-lurah.show');
        Route::post('/skp/get-lampiran', [SkpLurahController::class, 'show'])->name('skp-lurah.show');
        Route::post('/sktm/get-lampiran', [SktmLurahController::class, 'show'])->name('sktm-lurah.show');
        Route::post('/ski/get-lampiran', [SkiLurahController::class, 'show'])->name('ski-lurah.show');

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

        Route::resource('sku-lurah', LurahBusinessCertificationController::class);
        Route::resource('skp-lurah', SkpLurahController::class);
        Route::resource('sktm-lurah', SktmLurahController::class);
        Route::resource('ski-lurah', SkiLurahController::class);
        Route::resource('akun-lurah', ProfileLurahController::class);
    });

// Route Staff
Route::prefix('/pages/dashboard/staff')
    ->middleware(['auth', 'staff'])
    ->group(function () {
        Route::get('/', [DashboardStaffController::class, 'index'])->name('staff.dashboard');

        // Route get lampiran sku
        Route::get('/sku/cetak/{id}', [CetakController::class, 'cetak_sku'])->name('sku-staff.cetak-sku');
        Route::post('/sku/get-lampiran', [StaffBusinessCertificationController::class, 'show'])->name('sku-staff.show');
        Route::post('/sku/get-detail-users', [StaffBusinessCertificationController::class, 'showDetails'])->name('sku-staff.showDetails');
        Route::post('/sku/tolak-sku', [StaffBusinessCertificationController::class, 'tolakSku'])->name('sku-staff.tolak');
        Route::post('/sku/show/tolak-sku', [StaffBusinessCertificationController::class, 'showTolakSku'])->name('sku-staff.show-tolak-sku');
        Route::get('/sku-staff/diproses', [StaffBusinessCertificationController::class, 'onProgress'])->name('sku-staff.onProgress');
        Route::get('/sku-staff/selesai', [StaffBusinessCertificationController::class, 'success'])->name('sku-staff.success');
        Route::get('/sku-staff/ditolak', [StaffBusinessCertificationController::class, 'rejected'])->name('sku-staff.rejected');

        // Route get lampiran skp
        Route::get('/skp/cetak/{id}', [CetakController::class, 'cetak_skp'])->name('skp-staff.cetak-skp');
        Route::post('/skp/get-lampiran', [SkpStaffController::class, 'show'])->name('skp-staff.show');
        Route::post('/skp/tolak-skp', [SkpStaffController::class, 'tolakSkp'])->name('skp-staff.tolak');

        // Route get lampiran sktm
        Route::get('/sktm/cetak/{id}', [CetakController::class, 'cetak_sktm'])->name('sktm-staff.cetak-sktm');
        Route::post('/sktm/get-lampiran', [SktmStaffController::class, 'show'])->name('sktm-staff.show');
        Route::post('/sktm/tolak-sktm', [SktmStaffController::class, 'tolakSktm'])->name('sktm-staff.tolak');

        // Route get lampiran ski
        Route::get('/ski/cetak/{id}', [CetakController::class, 'cetak_ski'])->name('ski-staff.cetak-ski');
        Route::post('/ski/get-lampiran', [SkiStaffController::class, 'show'])->name('ski-staff.show');
        Route::post('/ski/tolak-ski', [SkiStaffController::class, 'tolakSki'])->name('ski-staff.tolak');

        // Route get akun, edit akun, ubah foto
        Route::post('/get-akun', [ProfileStaffController::class, 'show'])->name('staff.get-akun');
        Route::post('/akun/update', [ProfileStaffController::class, 'update'])->name('staff.update-akun');
        Route::post('/ubah-foto', [ProfileStaffController::class, 'ubahFoto'])->name('staff.ubah-foto');


        // Route get penduduk
        Route::get('/penduduk', [DashboardStaffController::class, 'getPenduduk'])->name('staff.penduduk');
        Route::get('/verifikasi-penduduk', [DashboardStaffController::class, 'verifikasiPenduduk'])->name('staff.verifikasi-penduduk');
        Route::get('/verifikasi-penduduk/detail/{id}', [DashboardStaffController::class, 'detailVerifikasi'])->name('staff.detail-verifikasi');
        Route::post('/verifikasi-penduduk/verifikasi', [DashboardStaffController::class, 'verifikasi'])->name('staff.verifikasi');
        Route::post('/verifikasi-penduduk/tolak', [DashboardStaffController::class, 'tolakVerifikasi'])->name('staff.tolak-verifikasi');

        // Route Resource
        Route::resource('sku-staff', StaffBusinessCertificationController::class);
        Route::resource('skp-staff', SkpStaffController::class);
        Route::resource('sktm-staff', SktmStaffController::class);
        Route::resource('ski-staff', SkiStaffController::class);
        Route::resource('akun-staff', ProfileStaffController::class);
    });

// Route User
Route::prefix('/pages/dashboard/user')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('user.dashboard');
        Route::get('/lengkapi-data', [ProfileUserController::class, 'completeProfile'])->name('complete-profile');

        // Route get akun, edit akun, ubah foto dan get penolakan
        Route::post('/get-akun', [ProfileUserController::class, 'show'])->name('user.get-akun');
        Route::post('/akun/update', [ProfileUserController::class, 'update'])->name('user.update-akun');
        Route::post('/ubah-foto', [ProfileUserController::class, 'ubahFoto'])->name('user.ubah-foto');
        Route::post('/get-penolakan', [DashboardUserController::class, 'getPenolakan'])->name('get-penolakan');
        Route::post('/sku/show/tolak-sku', [UserBusinessCertificationController::class, 'showTolakSku'])->name('sku-user.show-tolak-sku');

        // Route Resource
        Route::resource('sku-user', UserBusinessCertificationController::class);
        Route::resource('skp-user', UserFuneralCertificationController::class);
        Route::resource('sktm-user', UserIncapacityCertificationController::class);
        Route::resource('ski-user', UserPermitsController::class);
        Route::resource('akun-user', ProfileUserController::class);
    });


Auth::routes();
