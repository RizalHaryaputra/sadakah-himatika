<?php

use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DirektoriBankSampahController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\PadukuhanController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\ProdukKerajinanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetoranSampahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::post('/redemption-request', [FrontController::class, 'storeRedemptionRequest'])->name('front.redemption-request');
Route::get('/produk', [FrontController::class, 'products'])->name('front.products');
Route::get('/produk/{produk:slug}', [FrontController::class, 'productDetail'])->name('front.product-detail');
Route::get('/artikel', [FrontController::class, 'articles'])->name('front.articles');
Route::get('/artikel/{artikel:slug}', [FrontController::class, 'articleDetail'])->name('front.article-detail');
Route::get('/hadiah', [FrontController::class, 'rewards'])->name('front.rewards');
Route::get('/hadiah/{hadiah}', [FrontController::class, 'rewardDetail'])->name('front.reward-detail');
Route::get('/bank-sampah', [FrontController::class, 'bank'])->name('front.bank');
Route::get('/bank-sampah/{bank:slug}', [FrontController::class, 'bankDetail'])->name('front.bank-detail');
Route::get('/kategori-sampah', [FrontController::class, 'category'])->name('front.category');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// == RUTE NASABAH ==
Route::middleware(['auth', 'role:Nasabah'])->prefix('nasabah')->name('nasabah.')->group(function () {
    Route::get('/riwayat-penukaran', [NasabahController::class, 'riwayatPenukaran'])->name('riwayat-penukaran');
    Route::get('/riwayat-setoran', [NasabahController::class, 'riwayatSetoran'])->name('riwayat-setoran');
    Route::delete('/cancel-penukaran/{penukaranPoin}', [NasabahController::class, 'cancel'])->name('cancel-penukaran');
    Route::get('/dashboard', [NasabahController::class, 'index'])->name('dashboard');
    Route::get('/profile', [NasabahController::class, 'profile'])->name('profile');
    Route::get('/profile/{pengguna}/edit', [NasabahController::class, 'edit'])->name('edit-profile');
    Route::put('/profile/{pengguna}', [NasabahController::class, 'update'])->name('update-profile');
});

// == RUTE SUPER ADMIN & OPERATOR ==
// Semua rute di sini memerlukan login dan memiliki role 'Super Admin' atau 'Operator Padukuhan'.
// URL akan memiliki prefix /admin (contoh: your-domain.com/admin/dashboard)

Route::middleware(['auth', 'role:Super Admin|Operator Padukuhan'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/setoran/export', [SetoranSampahController::class, 'export'])->name('setoran.export');
    Route::resource('setoran', SetoranSampahController::class);
    Route::get('/pengguna/export', [UserController::class, 'export'])->name('pengguna.export');
    Route::resource('pengguna', UserController::class);
    Route::get('/dashboard-operator', [OperatorDashboardController::class, 'index'])->name('dashboard-operator');
    Route::get('/riwayat-penukaran', [OperatorDashboardController::class, 'riwayatPenukaran'])->name('riwayat-penukaran');
    
    // == RUTE KHUSUS SUPER ADMIN ==
    // Rute di dalam grup ini HANYA bisa diakses oleh 'Super Admin'.
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::resource('artikel', ArtikelController::class);
        Route::resource('bank', DirektoriBankSampahController::class);
        Route::resource('hadiah', HadiahController::class);
        Route::resource('padukuhan', PadukuhanController::class);
        Route::get('/penukaran/export', [PenukaranPoinController::class, 'export'])->name('penukaran.export');
        Route::resource('penukaran', PenukaranPoinController::class);
        Route::resource('produk', ProdukKerajinanController::class);
        Route::resource('kategori', KategoriSampahController::class);
        Route::post('/approve/{penukaranPoin}', [PenukaranPoinController::class, 'approve'])->name('penukaran.approve');
        Route::post('/reject/{penukaranPoin}', [PenukaranPoinController::class, 'reject'])->name('penukaran.reject');
        Route::post('/markcollected/{penukaranPoin}', [PenukaranPoinController::class, 'markCollected'])->name('penukaran.markCollected');
        Route::get('/dashboard-admin', [SuperAdminDashboardController::class, 'index'])->name('dashboard-admin');
    });
});


require __DIR__ . '/auth.php';
