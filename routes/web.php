<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPelangganController;
use App\Http\Controllers\AdminPengaturanController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 1. ZONA PUBLIK / GUEST
Route::get('/', function () {
    $status = Auth::check()
        ? 'Login sebagai: ' . Auth::user()->nama . ' (' . Auth::user()->role . ')'
        : 'Mode Guest (Belum Login)';

    return "
        <div style='font-family:sans-serif; padding:40px;'>
            <h2>🍗 Beranda Dapur Ayam Geprek</h2>
            <p>Status saat ini: <strong>{$status}</strong></p>
            <a href='/login'>Ke Halaman Login</a> |
            <a href='/register'>Ke Halaman Register</a> |
            <a href='/admin/dashboard'>Ke Admin Dashboard</a>
            " . (Auth::check() ? "<form action='/logout' method='POST' style='margin-top:15px;'>" . csrf_field() . "<button type='submit'>Logout</button></form>" : "") . "
        </div>
    ";
})->name('home');

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('checkislogin')->name('logout');

// 2. ZONA PELANGGAN
Route::middleware(['checkislogin', 'checkrole:pelanggan'])->group(function () {
    // Rute Pelanggan (Tahap 5)
});

// 3. ZONA ADMIN DASHBOARD
Route::prefix('admin')->name('admin.')->middleware(['checkislogin', 'checkrole:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('menu', AdminMenuController::class)->except(['show']);

    // Kelola Pesanan & Verifikasi Pembayaran
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::patch('/pembayaran/{pembayaran}/verifikasi', [AdminPesananController::class, 'verifikasiPembayaran'])->name('pembayaran.verifikasi');

    // Data Pelanggan
    Route::get('/pelanggan', [AdminPelangganController::class, 'index'])->name('pelanggan.index');

    // Pengaturan Toko
    Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
});