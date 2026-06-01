@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <h2 class="mb-4">Daftar Produk</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    <span class="badge bg-info text-dark">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection