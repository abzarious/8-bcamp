<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - 8Mall</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-xs sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600 tracking-tight">8Mall</a>
                
                <div class="flex items-center gap-6">
                    @auth
                        <span class="text-sm text-gray-500 hidden sm:inline">Halo, <strong class="text-gray-800">{{ Auth::user()->name }}</strong></span>
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-600 hover:text-orange-600 transition-colors">Profil Saya</a>
                        <a href="{{ route('orders.index') }}" class="text-sm font-medium text-gray-600 hover:text-orange-600 transition-colors">Pesanan Saya</a>
                        
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">⚙️ Admin Panel</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline flex items-center">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600 transition-colors cursor-pointer">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-orange-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-xs">Daftar</a>
                    @endauth
                </div>
            </div>
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
                    <h1 class="text-2xl font-bold text-gray-900 mt-3">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-orange-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <h3 class="text-sm font-semibold text-gray-900">Deskripsi</h3>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-100 pt-4">
                    @auth
                        <form action="{{ route('checkout.store', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Jumlah Pembelian</label>
                                <input type="number" name="quantity" value="1" min="1" class="mt-1 block w-24 rounded-lg border border-gray-300 px-3 py-1.5 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 08123456789" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase">Alamat Pengiriman Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Tuliskan alamat lengkap pengiriman paket..." required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 text-sm">{{ old('address', Auth::user()->address) }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors shadow-md shadow-orange-500/10 text-center block cursor-pointer text-sm">
                                Beli Sekarang
                            </button>
                        </form>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-600 mb-3">Silakan masuk ke akun Anda terlebih dahulu untuk melakukan transaksi pembelian.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-6 py-2 rounded-lg transition-colors">
                                Login / Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

        </div>
    </main>

</body>
</html>