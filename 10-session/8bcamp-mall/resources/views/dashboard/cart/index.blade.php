@extends('layouts.app')
@section('title', 'Cart')

@section('content')
<h2>Cart</h2>
<table class="table table-hover mt-4">
    <thead class="table-dark">
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Produk Kece #1</td>
            <td>Rp 50.000</td>
            <td>1</td>
            <td>Rp 50.000</td>
        </tr>
    </tbody>
</table>
<div class="text-end mt-3">
    <h4>Total: <span class="text-primary">Rp 50.000</span></h4>
    <button class="btn btn-success mt-2 px-5">Checkout</button>
</div>
@endsection