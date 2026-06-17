<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique'   => 'Kategori dengan nama tersebut sudah terdaftar.',
        ]);

    
        $validatedData['slug'] = Str::slug($request->name);

        Category::create($validatedData);

        return redirect()->route('dashboard.categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // 🔒 KEAMANAN: Abaikan validasi unique untuk ID kategori ini sendiri saat update
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong!',
            'name.unique'   => 'Nama kategori tersebut sudah digunakan.',
        ]);

        // Otomatisasi pembaruan slug baru berbasis nama
        $validatedData['slug'] = Str::slug($request->name);

        // Update data di database
        $category->update($validatedData);

        return redirect()->route('dashboard.categories.index')
                        ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // Hubungkan penghapusan atau proteksi jika kategori masih memiliki produk (opsional)
        $category->delete();

        return redirect()->route('dashboard.categories.index')
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}
