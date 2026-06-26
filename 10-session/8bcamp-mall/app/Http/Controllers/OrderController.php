<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Tampilkan riwayat pesanan milik customer yang sedang login
    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Proses submit checkout transaksi
    public function checkout(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:9',
        ]);

        $product = Product::findOrFail($productId);
        $totalPrice = $product->price * $request->quantity;

        // Simpan ke database
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id, // Menggunakan properti tanpa ()
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'pending'
        ]);

        // Berhasil simpan, lempar ke halaman list order dengan flash session success
        return redirect()->route('orders.index')->with('success', 'Transaksi checkout berhasil dibuat!');
    }
    // Halaman list semua order di Dashboard Admin
    public function adminIndex()
    {
        // Pastikan hanya admin yang bisa mengakses data master ini
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function myOrders()
    {
        // Mengambil order milik user yang sedang login
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('home.my_orders', compact('orders'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            // Hapus berkas lama jika user melakukan penggantian bukti transfer
            if ($order->payment_proof) {
                Storage::disk('public')->delete($order->payment_proof);
            }

            // Simpan langsung ke root disk 'public' agar tidak membuat sub-folder baru yang membingungkan
            // File akan otomatis masuk ke storage/app/public/ dan dinamai acak secara aman
            $path = $request->file('payment_proof')->store('', 'public');
            
            $order->update([
                'payment_proof' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Bukti transfer berhasil diperbarui!');
    }
}