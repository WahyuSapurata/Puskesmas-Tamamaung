<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\PosYanduController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuskesmasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::resource('puskesmas', PuskesmasController::class);
});

Route::middleware('auth', 'is_admin_puskesmas')->group(function () {
    Route::resource('posyandu', PosYanduController::class);
    Route::get('pendataan-report', [PendataanController::class, 'report'])->name('pendataan.report');
    Route::get('pendataan-cetak-report', [PendataanController::class, 'cetakReport'])->name('pendataan.cetak-report');
});

Route::middleware('auth', 'is_posyandu')->group(function () {
    Route::resource('pendataan', PendataanController::class);
    Route::get('pendataan-cetak', [PendataanController::class, 'cetak'])->name('pendataan.cetak');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
