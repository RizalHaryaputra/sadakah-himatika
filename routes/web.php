<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DirektoriBankSampahController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\PadukuhanController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\ProdukKerajinanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetoranSampahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// == RUTE SUPER ADMIN & OPERATOR ==
// Semua rute di sini memerlukan login dan memiliki role 'Super Admin' atau 'Operator Padukuhan'.
// URL akan memiliki prefix /admin (contoh: your-domain.com/admin/dashboard)

Route::middleware(['auth', 'role:Super Admin|Operator Padukuhan'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('setoran', SetoranSampahController::class);
    
    // == RUTE KHUSUS SUPER ADMIN ==
    // Rute di dalam grup ini HANYA bisa diakses oleh 'Super Admin'.
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::resource('artikel', ArtikelController::class);
        Route::resource('bank', DirektoriBankSampahController::class);
        Route::resource('hadiah', HadiahController::class);
        Route::resource('padukuhan', PadukuhanController::class);
        Route::resource('penukaran', PenukaranPoinController::class);
        Route::resource('produk', ProdukKerajinanController::class);
        Route::resource('kategori', KategoriSampahController::class);

    });
});


require __DIR__.'/auth.php';
