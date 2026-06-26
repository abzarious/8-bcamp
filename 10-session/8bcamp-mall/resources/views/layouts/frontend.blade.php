<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8Mall - E-Commerce</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800">

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

                        <form method="POST" action="{{ route('logout') }}" class="inline flex items-center m-0">
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>