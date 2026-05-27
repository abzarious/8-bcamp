
@extends('layouts.app')
@section('title',  $title)

@section('content')
<h2>Katalog Produk</h2>
<div class="row mt-4">
    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="bg-secondary text-white text-center py-5 rounded-top">Gambar Produk {{ $product->image }}</div>
            <div class="card-body">
                <h5 class="card-title">Produk Kece #{{ $product->name }}</h5>
                <p class="card-text text-success fw-bold">Stock : {{ $product->stock }}</p>
                <button class="btn btn-outline-dark w-100">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection