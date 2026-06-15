<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Input Form --}}
                    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
                        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            
                            <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-6 sm:px-10 text-white">
                                <h2 class="text-2xl font-bold">Tambah Produk Baru</h2>
                                <p class="text-orange-100 text-sm mt-1">Masukkan informasi detail produk untuk ditambahkan ke Hachi Mall.</p>
                            </div>

                            <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-6">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors @error('name') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror" 
                                            placeholder="Contoh: Sepatu Running Nike Air">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                        <select name="category_id" id="category_id" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors bg-white @error('category_id') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>    
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Produk (Rp) <span class="text-red-500">*</span></label>
                                        <div class="relative mt-1 rounded-xl shadow-sm">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="price" id="price" value="{{ old('price') }}" min="0"
                                                class="w-full pl-11 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors @error('price') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror" 
                                                placeholder="0">
                                        </div>
                                        @error('price')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok <span class="text-red-500">*</span></label>
                                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors @error('stock') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror" 
                                            placeholder="0">
                                        @error('stock')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Produk <span class="text-red-500">*</span></label>
                                        <textarea name="description" id="description" rows="4" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors @error('description') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror" 
                                            placeholder="Tuliskan spesifikasi lengkap, ukuran, warna, dan detail produk lainnya...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk <span class="text-red-500">*</span></label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-orange-500 transition-colors @error('image') border-red-500 hover:border-red-500 @enderror">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h20a4 4 0 004-4V20m-10-4l-6 6m0 0l-6-6m6 6v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600 justify-center">
                                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-semibold text-orange-600 hover:text-orange-500 focus-within:outline-none">
                                                        <span>Unggah file</span>
                                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                                    </label>
                                                    <p class="pl-1">atau seret ke sini</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                                            </div>
                                        </div>
                                        @error('image')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        
                                        <div id="image-preview-wrapper" class="mt-3 hidden">
                                            <p class="text-xs font-medium text-gray-500 mb-1">Pratinjau Gambar:</p>
                                            <img id="image-preview" src="#" alt="Preview" class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                                    <a href="{{ route('dashboard.products.index') }}" 
                                        class="px-5 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                        class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl text-sm font-medium hover:from-orange-600 hover:to-amber-600 transition-all shadow-sm shadow-orange-500/20 active:scale-[0.98]">
                                        Simpan Produk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@push('scripts')
    @vite('resources/js/product.js')
@endpush
</x-app-layout>