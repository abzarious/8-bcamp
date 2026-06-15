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
            'name.required' => 'Nama kategori tidak boleh kosong!',
            'name.unique'   => 'Nama kategori tersebut sudah ada.',
        ]);
        
        $validatedData['slug'] = Str::slug($request->name);

        Category::create($validatedData);

        return redirect()->route('dashboard.categories.index')
                         ->with('success', 'Kategori baru sukses ditambahkan!');
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
    public function edit(string $id)
    {
        //
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
