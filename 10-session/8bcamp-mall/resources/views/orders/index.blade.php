@extends('layouts.frontend')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 tracking-tight">Pesanan Saya</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($orders as $order)
            <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                
                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">ID Transaksi #{{ $order->id }}</span>
                        
                        @if($order->status === 'pending')
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-amber-100 text-amber-800 uppercase">Pending</span>
                        @elseif($order->status === 'processing')
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-100 text-blue-800 uppercase">Processing (Dikemas)</span>
                        @elseif($order->status === 'shipped')
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-800 uppercase">Shipped (Dikirim)</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-gray-100 text-gray-800 uppercase">{{ $order->status }}</span>
                        @endif
                    </div>
                    
                    <h4 class="text-lg font-bold text-gray-900 mt-2">{{ $order->product->name ?? 'Produk Terhapus' }}</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Jumlah: {{ $order->quantity }} barang</p>
                    <p class="text-xl font-black text-orange-600 mt-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>

                <div class="w-full md:w-80 bg-gray-50 p-4 rounded-xl border border-gray-200/60">
                    @if($order->payment_proof)
                        <div class="text-center bg-green-50 border border-green-100 p-3 rounded-lg mb-3">
                            <span class="text-xs text-green-700 font-bold block">✓ Bukti transfer sudah diupload</span>
                            <a href="{{ asset('images/' . $order->payment_proof) }}" target="_blank" class="text-xs text-blue-600 font-semibold underline hover:text-blue-800 mt-1 inline-block">Lihat Gambar Bukti</a>
                        </div>
                        
                        <details class="cursor-pointer">
                            <summary class="text-xs text-gray-500 font-medium hover:text-orange-600 text-center list-none">⚙️ Ganti Bukti Transfer</summary>
                            <form action="{{ route('orders.confirm_payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 m-0 mt-3 pt-3 border-t border-gray-200">
                                @csrf
                                <input type="file" name="payment_proof" class="text-xs text-gray-500 file:bg-gray-200 file:text-gray-700 file:border-0 file:rounded-md file:py-1 file:px-2 cursor-pointer w-full" required>
                                <button type="submit" class="bg-gray-800 hover:bg-black text-white text-xs py-1.5 rounded-lg font-semibold transition-colors cursor-pointer text-center">Update Bukti Baru</button>
                            </form>
                        </details>
                    @else
                        <form action="{{ route('orders.confirm_payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 m-0">
                            @csrf
                            <label class="text-xs font-bold text-gray-700">Belum Ada Pembayaran:</label>
                            <input type="file" name="payment_proof" class="text-xs text-gray-500 file:bg-orange-50 file:text-orange-700 file:border-0 file:rounded-md file:py-1 file:px-2 cursor-pointer w-full" required>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white text-xs py-2 rounded-lg font-semibold transition-colors cursor-pointer text-center">Kirim Bukti Transfer</button>
                        </form>
                    @endif
                </div>

            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-xl border border-gray-100 text-gray-400">
                Kamu belum pernah melakukan pesanan transaksi apapun.
            </div>
        @endforelse
    </div>
</div>
@endsection