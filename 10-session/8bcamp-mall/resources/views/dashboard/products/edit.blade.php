<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="max-w-3xl mx-auto bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-6 text-white">
                            <h2 class="text-2xl font-bold">Ubah Informasi Produk</h2>
                            <p class="text-orange-100 text-sm mt-1">Perbarui data produk yang terdaftar pada sistem 8Mall.</p>
                        </div>

                        <form action="" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-6">
                            
                            @method('PUT') <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-colors @error('name') border-red-500 @enderror">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                    <select name="category" id="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 bg-white">
                                        <option value="Elektronik" {{ old('category', $product->category) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                        <option value="Pakaian" {{ old('category', $product->category) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                        <option value="Sepatu" {{ old('category', $product->category) == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Produk (Rp) <span class="text-red-500">*</span></label>
                                    <div class="relative mt-1 rounded-xl shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="w-full pl-11 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500">
                                    </div>
                                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok <span class="text-red-500">*</span></label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500">
                                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
                                    <input type="file" id="image" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                                    
                                    <div id="image-preview-wrapper" class="mt-4">
                                        <p class="text-xs font-medium text-gray-500 mb-1">Pratinjau Gambar:</p>
                                        <img id="image-preview" src="{{ $product->image ? asset('storage/' . $product->image) : '#' }}" alt="Preview" class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                                <a href="{{ route('dashboard.products.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl text-sm font-medium hover:from-orange-600 shadow-sm">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@push('scripts')
    @vite('resources/js/product.js')
@endpush
</x-app-layout>

