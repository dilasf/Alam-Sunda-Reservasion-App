<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DetailMenuController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Frontend\FrontendPemesananController;
use App\Http\Controllers\Frontend\FrontendReservasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Pelanggan
// Route::get('/dashboard', function () {
//     return view('frontend.dashboard');
// })->middleware(['auth', 'verified', 'pelanggan'])->name('frontend.dashboard');
Route::middleware(['auth', 'verified', 'pelanggan'])
    ->prefix('pelanggan')
    ->name('frontend.reservasi.')
    ->group(function() {
        Route::get('/dashboard', [FrontendReservasiController::class, 'createReservasi'])->name('dashboard');
        Route::post('/store', [FrontendReservasiController::class, 'storeReservasi'])->name('store');
        Route::get('/upload/{idTransaksi}', [FrontendReservasiController::class, 'showUploadBukti'])->name('upload');
        Route::post('/upload/{idTransaksi}', [FrontendReservasiController::class, 'uploadBukti'])->name('upload.store');
        Route::get('/success/{idReservasi}', [FrontendReservasiController::class, 'success'])->name('success');
});

Route::middleware(['auth', 'verified', 'pelanggan'])
    ->prefix('pelanggan')
    ->name('frontend.pemesanan.')
    ->group(function() {
        // Tampilan menu dan pemesanan
        Route::get('/', [FrontendPemesananController::class, 'index'])->name('index');

        // Proses pesanan
        Route::post('/process', [FrontendPemesananController::class, 'processPesanan'])->name('process');

        // Detail menu
        Route::get('/menu/{id}', [FrontendPemesananController::class, 'getMenuWithDetails'])->name('menu.details');

        // Form pengiriman dan penyimpanan
        Route::get('/{idPesanan}/pengiriman', [FrontendPemesananController::class, 'showPengirimanForm'])->name('pengiriman');
        Route::post('/{idPesanan}/pengiriman', [FrontendPemesananController::class, 'storePengiriman'])->name('pengiriman.store');
        Route::get('/pemesanan/{idPesanan}/upload', [FrontendPemesananController::class, 'showUploadForm'])->name('upload');
Route::post('/pemesanan/{idPesanan}/transaksi', [FrontendPemesananController::class, 'storeTransaksi'])->name('transaksi.store');
Route::get('/pemesanan/{idPesanan}/status', [FrontendPemesananController::class, 'showTransactionStatus'])->name('status');
});
// Route::prefix('reservasi')->name('frontend.reservasi.')->group(function () {
//     Route::get('/dashboard', [FrontendReservasiController::class, 'createReservasi'])->name('create');
//     Route::post('/store', [FrontendReservasiController::class, 'storeReservasi'])->name('store');
//     Route::get('/upload/{idTransaksi}', [FrontendReservasiController::class, 'showUploadBukti'])->name('upload');
//     Route::post('/upload/{idTransaksi}', [FrontendReservasiController::class, 'uploadBukti'])->name('upload.store');
//     Route::get('/success', [FrontendReservasiController::class, 'success'])->name('success');
// });
//owner
Route::get('/owner/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth', 'verified', 'owner'])->name('owner.dashboard');



Route::middleware(['auth','verified','admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/dashboard',[AdminController::class, 'index'])->name('dashboard.index');
    Route::resource('/detail', DetailMenuController::class)->parameters([
        'detail' => 'detailMenu'
    ]);
    Route::resource('/menu', MenuController::class);
    Route::resource('/meja', MejaController::class);
    Route::resource('/reservasi', ReservasiController::class);
    Route::get('/reservasi/{reservasi}/detail', [ReservasiController::class, 'detail'])
        ->name('reservasi.detail');
    Route::resource('/transaksi', TransaksiController::class);
});
//admin
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard.index');
// })->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
