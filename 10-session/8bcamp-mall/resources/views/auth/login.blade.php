{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-800">Selamat Datang Kembali!</h2>
        <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Hachi Mall Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-slate-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-slate-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4 text-sm">
            <label for="remember_me" class="inline-flex items-center select-none">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-orange-500 focus:ring-orange-500" name="remember">
                <span class="ms-2 text-slate-600">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-slate-500 hover:text-orange-600 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        
        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition active:scale-[0.98] duration-150">
                {{ __('Masuk Ke Akun') }}
            </button>
        </div>

    
        <div class="mt-6 text-center text-sm text-slate-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-orange-500 hover:text-orange-600 underline">
                Daftar Sekarang
            </a>
        </div>
    </form>
</x-guest-layout>