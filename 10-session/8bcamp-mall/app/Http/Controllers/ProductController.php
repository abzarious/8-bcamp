<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Otomatisasi generate data slug produk
        $validatedData['slug'] = Str::slug($request->name);

       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $filename = time() . '_' . Str::slug($validatedData['name']) . '.' . $image->getClientOriginalExtension();
            
            $path = $image->storeAs('products', $filename, 'public');
            
            $validatedData['image'] = $path;
        }

        // Menyimpan record produk utuh ke database
        Product::create($validatedData);

        return redirect()->route('dashboard.products.index')
                         ->with('success', 'Produk baru berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    
    public function update(Request $request, Product $product)
    {
        // 🔒 KEAMANAN: Validasi input (kolom image dijadikan 'nullable' karena bersifat opsional saat edit)
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        // Otomatisasi generate data slug baru
        $validatedData['slug'] = Str::slug($request->name);

        // 🔒 KEAMANAN & PENANGANAN BERKAS GAMPANG: Jika user mengunggah foto baru
        if ($request->hasFile('image')) {
            
            // Hapus foto lama dari server agar tidak menjadi sampah penyimpanan
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validatedData['name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $filename, 'public');
            
            $validatedData['image'] = $path;
        }

        // Eksekusi update ke database
        $product->update($validatedData);

        return redirect()->route('dashboard.products.index')
                        ->with('success', 'Produk berhasil diperbarui!');
    }

    
    public function destroy(Product $product)
    {
        // 🔒 KEAMANAN: Hapus file gambar asli dari server sebelum menghapus record dari DB
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')
                        ->with('success', 'Produk berhasil dihapus dari sistem!');
    }
}
