<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DetailMenuController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservasiController;
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
