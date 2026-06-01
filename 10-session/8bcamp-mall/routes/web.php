<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

// Route::get('/products', function () {
//     return view('products');
// });

Route::get('/cart', function () {
    return view('dashboard.cart.index');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::resource('products', ProductController::class);