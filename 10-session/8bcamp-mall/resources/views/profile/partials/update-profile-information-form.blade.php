<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900"> Informasi Profil </h2>
        <p class="mt-1 text-sm text-gray-600"> Perbarui informasi akun, foto profil, nomor hp, dan alamat pengiriman Anda. </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 border border-gray-300 flex-shrink-0">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center font-bold text-gray-400">8M</div>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                <input type="file" name="avatar" class="text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 cursor-pointer">
                <x-input-error class="mt-1" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" value="Nomor Handphone" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" placeholder="Contoh: 08123456789" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" value="Alamat Lengkap Pengiriman" />
            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-xs focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 text-gray-800" placeholder="Tulis jalan, nomor rumah, RT/RW, kecamatan, kota, dan kode pos...">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl text-sm font-medium transition-colors cursor-pointer">Simpan Perubahan</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">✓ Berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>