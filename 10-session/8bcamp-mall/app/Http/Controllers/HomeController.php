<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Sesuaikan jika nama model Anda ProductCategory
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman utama e-commerce (Katalog Produk)
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // Memulai query produk
        $query = Product::query();

        // Jika ada filter kategori dari frontend
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Jika ada pencarian produk
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('home.index', compact('products', 'categories'));
    }

    // Menampilkan detail produk sekaligus mencatat Klik pengguna
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Logika Increment Klik: Menambah +1 setiap kali halaman detail diakses oleh user
        $product->increment('click');

        return view('home.show', compact('product'));
    }
}