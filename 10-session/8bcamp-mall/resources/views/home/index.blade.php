<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8Mall - E-Commerce</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600">8Mall</a>
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-orange-600">Ke Dashboard Admin →</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-8 flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-4 rounded-xl shadow-xs">
            <form action="{{ route('home') }}" method="GET" class="w-full flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk impianmu..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500">
                
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">Filter</button>
                @if(request('search') || request('category'))
                    <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-center transition-colors">Reset</a>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="aspect-square bg-gray-100 w-full relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">No Image</div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 min-h-[40px]">{{ $product->name }}</h3>
                            <p class="text-orange-600 font-semibold mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <span class="text-xs text-gray-400 mt-2 block">👁 {{ $product->click }} dilihat</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('product.show', $product->id) }}" class="w-full block text-center bg-orange-50 hover:bg-orange-100 text-orange-600 font-medium py-2 rounded-lg text-sm transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    Produk tidak ditemukan.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    </main>
</body>
</html>