<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data agregasi riil dari database terlebih dahulu
        $jumlahUser = User::count();
        $jumlahProduk = Product::count();
        $jumlahKategori = Category::count();
        $jumlahKlikProduk = Product::sum('click');
        $jumlahOrder = Order::count();
        $totalPendapatan = Order::sum('total_price');

        // Masukkan variabel riil ke dalam array 'total' masing-masing card
        $totals_data = [
            [
                'name' => 'Product',
                'total' => $jumlahProduk, // Diambil dari DB
                'bg_color' => 'bg-blue-200',
                'icon' => 'bi-box-seam',
            ],
            [
                'name' => 'Product Category',
                'total' => $jumlahKategori, // Diambil dari DB
                'bg_color' => 'bg-green-200',
                'icon' => 'bi-tags',
            ],
            [
                'name' => 'Order',
                'total' => $jumlahOrder, // Diambil dari DB
                'bg_color' => 'bg-yellow-200',
                'icon' => 'bi-cart-check',
            ],
            [
                'name' => 'User',
                'total' => $jumlahUser, // Diambil dari DB
                'bg_color' => 'bg-red-200',
                'icon' => 'bi-people',
            ],
            [
                'name' => 'Product Clicks',
                'total' => $jumlahKlikProduk, // Diambil dari DB
                'bg_color' => 'bg-purple-200',
                'icon' => 'bi-cursor',
            ],
        ];

        // Untuk Chart Mingguan, jika belum ditarik riil dari database, kita biarkan dummy dulu tidak apa-apa
        $weekly_order_data = [
            ['date' => '2026-06-1', 'total_order' => 5, 'revenue' => 100000],
            ['date' => '2026-06-2', 'total_order' => 10, 'revenue' => 200000],
            ['date' => '2026-06-3', 'total_order' => 15, 'revenue' => 300000],
            ['date' => '2026-06-4', 'total_order' => 20, 'revenue' => 400000],
            ['date' => '2026-06-5', 'total_order' => 25, 'revenue' => 500000],
            ['date' => '2026-06-6', 'total_order' => 30, 'revenue' => 600000],
            ['date' => '2026-06-7', 'total_order' => 35, 'revenue' => 700000],
        ];

        return view('dashboard', compact(
            'jumlahUser',
            'jumlahProduk',
            'jumlahKlikProduk',
            'jumlahKategori',
            'totals_data',
            'weekly_order_data',
            'jumlahOrder',
            'totalPendapatan'
        ));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan #' . $id . ' berhasil diubah menjadi ' . $request->status);
    }
}