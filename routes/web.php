<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MasterJenisTextController;
use App\Http\Controllers\MasterKegiatanController;
use App\Http\Controllers\MasterTimerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingGambarController;
use App\Models\MasterJenisText;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [Dashboard::class, 'welcome']);
Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Master text
Route::post('/master-text/data', [MasterJenisTextController::class, 'data'])->middleware(['auth', 'verified']);
Route::resource('/master-text', MasterJenisTextController::class)->except(['create', 'edit'])->middleware(['auth', 'verified']);

// Master timer
Route::post('/master-timer/data', [MasterTimerController::class, 'data'])->middleware(['auth', 'verified']);
Route::resource('/master-timer', MasterTimerController::class)->except(['create', 'edit'])->middleware(['auth', 'verified']);

// Master Gambar
Route::post('/master-gambar/data', [SettingGambarController::class, 'data'])->middleware(['auth', 'verified']);
Route::get('/get-logo', [SettingGambarController::class, 'getlogo']);
Route::get('/get-slider', [SettingGambarController::class, 'getSlider']);
Route::get('/get-bg', [SettingGambarController::class, 'bg']);
Route::resource('/master-gambar', SettingGambarController::class)->except(['create', 'edit'])->middleware(['auth', 'verified']);

// Master timer
Route::post('/master-kegiatan/data', [MasterKegiatanController::class, 'data'])->middleware(['auth', 'verified']);
Route::get('/get-kegiatan-univ', [MasterKegiatanController::class, 'getKegiatanUniv']);
Route::get('/get-kegiatan-fak', [MasterKegiatanController::class, 'getKegiatanFak']);
Route::get('/get-footer', [MasterKegiatanController::class, 'getfooter']);
Route::resource('/master-kegiatan', MasterKegiatanController::class)->except(['create', 'edit'])->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
