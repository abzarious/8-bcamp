<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {a
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::prefix('dashboard')->group(function () {
        // Halaman dashboard utama (Bisa diakses oleh semua role yang sudah login)
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // SUB-GROUP ADMIN: Khusus untuk rute produk dan kategori saja
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