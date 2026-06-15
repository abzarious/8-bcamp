<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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

        
        $validatedData['slug'] = Str::slug($request->name);

        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        
            $filename = time() . '_' . Str::slug($validatedData['name']) . '.' . $image->getClientOriginalExtension();
            
            $path = $image->storeAs('products', $filename, 'public');
            
            $validatedData['image'] = $path;
        }
        
        Product::create($validatedData);

        return redirect()->route('dashboard.products.index')
                         ->with('success', 'Produk berhasil disimpan ke database!');
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
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
