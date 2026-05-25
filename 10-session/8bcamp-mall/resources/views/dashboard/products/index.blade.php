
@extends('layouts.app')
@section('title',  $title)

@section('content')
<h2>Katalog Produk</h2>
<div class="row mt-4">
    @foreach ($products as $p)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="bg-secondary text-white text-center py-5 rounded-top">Gambar Produk {{ $p }}</div>
            <div class="card-body">
                <h5 class="card-title">Produk Kece #{{ $p }}</h5>
                {{-- <p class="card-text text-success fw-bold">Rp {{ number_format($p * 50000, 0, ',', '.') }}</p> --}}
                <button class="btn btn-outline-dark w-100">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection