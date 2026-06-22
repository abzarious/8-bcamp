<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - 8Mall</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow-sm h-16 flex items-center">
        <div class="max-w-7xl mx-auto px-4 w-full">
            <a href="{{ route('home') }}" class="text-orange-600 font-medium">← Kembali ke Katalog</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-8">
            <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden border border-gray-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                @endif
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold bg-orange-50 text-orange-600 px-2.5 py-1 rounded-full uppercase tracking-wider">
                        {{ $product->category->name ?? 'Umum' }}
                    </span>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mt-3">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-orange-600 mt-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="mt-6 border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900">Deskripsi Produk</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6">
                    <button onclick="alert('Fitur Checkout/Transaksi Berhasil Diintegrasikan!')" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors shadow-lg shadow-orange-500/20 text-center block cursor-pointer">
                        Beli Sekarang / Transaksi
                    </button>
                    <span class="text-xs text-gray-400 mt-3 block text-center">Produk ini telah diklik sebanyak {{ $product->click }} kali</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>