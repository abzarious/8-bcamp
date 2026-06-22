<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // <-- 1. Tambahkan import HomeController ini
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Akses Publik (Tanpa Login)
|--------------------------------------------------------------------------
*/
// Rute utama katalog e-commerce untuk user
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute detail produk (mencatat klik +1 setiap diakses user)
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');


/*
|--------------------------------------------------------------------------
| Web Routes - Harus Login Terlebih Dahulu (Middleware: Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    Route::prefix('dashboard')->group(function () {
        // Halaman dashboard utama (Menampilkan statistik jumlah produk, klik, dan kategori)
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // SUB-GROUP ADMIN: Khusus untuk rute kelola produk dan kategori saja
        Route::middleware('admin')->group(function () {
            Route::resource('/products', ProductController::class)->names('dashboard.products');
            Route::resource('/categories', CategoryController::class)->names('dashboard.categories');
        });
    });

    // Rute Profile (Bisa diakses oleh semua role yang sudah login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';