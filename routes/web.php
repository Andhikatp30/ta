<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KinerjaKurirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Menu
    Route::resource('barang', BarangController::class);
    Route::resource('kurir', KurirController::class);
    Route::get('/kinerja-kurir', [KinerjaKurirController::class, 'index'])->name('kinerja-kurir');
    
    Route::get('/pengiriman/create', [PengirimanController::class, 'create'])->name('pengiriman.create');
    Route::post('/pengiriman/store', [PengirimanController::class, 'store'])->name('pengiriman.store');
    Route::get('/pengiriman/{id}/edit', [PengirimanController::class, 'edit'])->name('pengiriman.edit');
    Route::put('/pengiriman/{id}', [PengirimanController::class, 'update'])->name('pengiriman.update');
    Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy'])->name('pengiriman.destroy');
    
    Route::get('/status-pengiriman', [PengirimanController::class, 'status'])->name('pengiriman.status');
    Route::get('/histori-pengiriman', [PengirimanController::class, 'histori'])->name('pengiriman.histori');
}); 
