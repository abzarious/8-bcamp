<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category; // Sesuaikan jika nama model Anda ProductCategory
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totals_data = [
            [
                'name' => 'Product',
                'total' => 100,
                'bg_color' => 'bg-blue-200',
                'icon' => 'bi-box-seam', // Icon Box untuk Produk
            ],
            [
                'name' => 'Product Category',
                'total' => 10,
                'bg_color' => 'bg-green-200',
                'icon' => 'bi-tags', // Icon Label/Tag untuk Kategori
            ],
            [
                'name' => 'Order',
                'total' => 100,
                'bg_color' => 'bg-yellow-200',
                'icon' => 'bi-cart-check', // Icon Keranjang untuk Order
            ],
            [
                'name' => 'User',
                'total' => 20,
                'bg_color' => 'bg-red-200',
                'icon' => 'bi-people', // Icon Orang untuk User
            ],
            [
                'name' => 'Product Clicks',
                'total' => 800,
                'bg_color' => 'bg-purple-200',
                'icon' => 'bi-cursor', // Icon Klik/Kursor
            ],
        ];

        $weekly_order_data = [
            [
                'date' => '2026-06-1',
                'total_order' => 5,
                'revenue' => 100000
            ],
            [
                'date' => '2026-06-2',
                'total_order' => 10,
                'revenue' => 200000
            ],
            [
                'date' => '2026-06-3',
                'total_order' => 15,
                'revenue' => 300000
            ],
            [
                'date' => '2026-06-4',
                'total_order' => 20,
                'revenue' => 400000
            ],
            [
                'date' => '2026-06-5',
                'total_order' => 25,
                'revenue' => 500000
            ],
            [
                'date' => '2026-06-6',
                'total_order' => 30,
                'revenue' => 600000
            ],
            [
                'date' => '2026-06-7',
                'total_order' => 35,
                'revenue' => 700000
            ],
        ];

        // 1. Menghitung Jumlah Semua Produk
        $jumlahProduk = Product::count();

        // 2. Menghitung Jumlah Total Klik dari Seluruh Produk
        $jumlahKlikProduk = Product::sum('click');

        // 3. Menghitung Jumlah Kategori Produk
        $jumlahKategori = Category::count();

        // 4. Menghitung Jumlah User
        $jumlahUser = User::count();

        // Mengirimkan data statistik ke view halaman dashboard admin
        return view('dashboard', compact('jumlahUser','jumlahProduk', 'jumlahKlikProduk', 'jumlahKategori', 'totals_data', 'weekly_order_data'));
    }
}