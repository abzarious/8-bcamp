<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="max-w-xl mx-auto bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-6 text-white">
                            <h2 class="text-xl font-bold">Ubah Kategori</h2>
                            <p class="text-orange-100 text-xs mt-1">Perbarui nama kelompok klasifikasi barang Anda.</p>
                        </div>

                        <form action="" method="POST" class="p-6 space-y-4">
                            
                            @method('PUT')

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 @error('name') border-red-500 @enderror">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                                <a href="{{ route('dashboard.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl text-sm font-medium hover:from-orange-600 shadow-sm">Perbarui</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>