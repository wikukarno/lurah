<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lurah\DashboardLurahController;
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
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\SkiUserController;
use App\Http\Controllers\User\SkpUserController;
use App\Http\Controllers\User\SktmUserController;
use App\Http\Controllers\User\SkuUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/pages/dashboard/lurah')
    ->middleware(['auth', 'lurah'])
    ->group(function () {
        Route::get('/', [DashboardLurahController::class, 'index'])->name('lurah.dashboard');

        Route::post('/skp/get-lampiran', [SkpLurahController::class, 'show'])->name('skp-lurah.show');
        Route::post('/sktm/get-lampiran', [SktmLurahController::class, 'show'])->name('sktm-lurah.show');
        Route::get('/laporan', [DashboardLurahController::class, 'getLaporan'])->name('lurah.laporan');

        Route::post('/get-akun', [ProfileLurahController::class, 'show'])->name('lurah.get-akun');
        Route::post('/akun/update', [ProfileLurahController::class, 'update'])->name('lurah.update-akun');
        Route::post('/ubah-foto', [ProfileLurahController::class, 'ubahFoto'])->name('lurah.ubah-foto');

        Route::get('/penduduk', [DashboardLurahController::class, 'getPenduduk'])->name('lurah.penduduk');
        Route::get('/download-laporan', [CetakController::class, 'downloadLaporan'])->name('export.laporan');

        Route::resource('sku-lurah', SkuLurahController::class);
        Route::resource('skp-lurah', SkpLurahController::class);
        Route::resource('sktm-lurah', SktmLurahController::class);
        Route::resource('ski-lurah', SkiLurahController::class);
        Route::resource('akun-lurah', ProfileLurahController::class);
    });

Route::prefix('/pages/dashboard/staff')
    ->middleware(['auth', 'staff'])
    ->group(function () {
        Route::get('/', [DashboardStaffController::class, 'index'])->name('staff.dashboard');
        Route::get('/sku/cetak/{id}', [CetakController::class, 'cetak_sku'])->name('sku-staff.cetak-sku');
        Route::post('/sku/get-lampiran', [SkuStaffController::class, 'show'])->name('sku-staff.show');
        Route::post('/sku/tolak-sku', [SkuStaffController::class, 'tolakSku'])->name('sku-staff.tolak');

        Route::get('/skp/cetak/{id}', [CetakController::class, 'cetak_skp'])->name('skp-staff.cetak-skp');
        Route::post('/skp/get-lampiran', [SkpStaffController::class, 'show'])->name('skp-staff.show');
        Route::post('/skp/tolak-skp', [SkpStaffController::class, 'tolakSkp'])->name('skp-staff.tolak');

        Route::get('/sktm/cetak/{id}', [CetakController::class, 'cetak_sktm'])->name('sktm-staff.cetak-sktm');
        Route::post('/sktm/get-lampiran', [SktmStaffController::class, 'show'])->name('sktm-staff.show');
        Route::post('/sktm/tolak-sktm', [SktmStaffController::class, 'tolakSktm'])->name('sktm-staff.tolak');

        Route::get('/ski/cetak/{id}', [CetakController::class, 'cetak_ski'])->name('ski-staff.cetak-ski');
        Route::post('/ski/get-lampiran', [SkiStaffController::class, 'show'])->name('ski-staff.show');
        Route::post('/ski/tolak-ski', [SkiStaffController::class, 'tolakSki'])->name('ski-staff.tolak');

        Route::post('/get-akun', [ProfileStaffController::class, 'show'])->name('staff.get-akun');
        Route::post('/akun/update', [ProfileStaffController::class, 'update'])->name('staff.update-akun');
        Route::post('/ubah-foto', [ProfileStaffController::class, 'ubahFoto'])->name('staff.ubah-foto');

        Route::get('/penduduk', [DashboardStaffController::class, 'getPenduduk'])->name('staff.penduduk');

        Route::resource('sku-staff', SkuStaffController::class);
        Route::resource('skp-staff', SkpStaffController::class);
        Route::resource('sktm-staff', SktmStaffController::class);
        Route::resource('ski-staff', SkiStaffController::class);
        Route::resource('akun-staff', ProfileStaffController::class);
    });

// User
Route::prefix('/pages/dashboard/user')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('user.dashboard');

        Route::post('/get-akun', [ProfileUserController::class, 'show'])->name('user.get-akun');
        Route::post('/akun/update', [ProfileUserController::class, 'update'])->name('user.update-akun');
        Route::post('/ubah-foto', [ProfileUserController::class, 'ubahFoto'])->name('user.ubah-foto');
        Route::post('/get-penolakan', [DashboardUserController::class, 'getPenolakan'])->name('get-penolakan');

        Route::resource('sku-user', SkuUserController::class);
        Route::resource('skp-user', SkpUserController::class);
        Route::resource('sktm-user', SktmUserController::class);
        Route::resource('ski-user', SkiUserController::class);
        Route::resource('akun-user', ProfileUserController::class);
    });


Auth::routes();
