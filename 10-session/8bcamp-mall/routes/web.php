<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// 1. Akses Publik (Frontend E-Commerce)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// 2. Harus Login (Customer & Admin)
// Pastikan rute transaksi dan admin lengkap seperti ini:
Route::middleware('auth')->group(function () {
    
    // Fitur Transaksi & Riwayat Pesanan untuk Customer
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/checkout/{productId}', [OrderController::class, 'checkout'])->name('checkout.store');
    
    // RUTE BARU: Aksi upload bukti transfer oleh customer
    Route::post('/orders/{id}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirm_payment');

    // Rute Atur Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Area Dashboard Admin
    Route::prefix('dashboard')->middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/products', ProductController::class)->names('dashboard.products');
        Route::resource('/categories', CategoryController::class)->names('dashboard.categories');
        
        Route::get('/orders', [OrderController::class, 'adminIndex'])->name('dashboard.orders.index');
        
        // RUTE BARU: Mengubah status order dari pending -> processing -> shipped
        Route::post('/orders/{id}/update-status', [DashboardController::class, 'updateOrderStatus'])->name('dashboard.orders.update_status');
    });
});

require __DIR__.'/auth.php';