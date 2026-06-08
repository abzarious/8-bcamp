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
                    {{-- Table --}}
                    <div class="w-full mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-5">
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Daftar Produk</h3>
                                <p class="text-sm text-slate-500">Kelola semua produk yang tersedia di Hachi Mall</p>
                            </div>
                            <a href="{{ route('dashboard.products.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/10 transition active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Produk
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-slate-150">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-slate-50 text-slate-600 text-xs font-bold uppercase tracking-wider border-b border-slate-200">
                                        <th class="py-4 px-6 text-center w-12">Id</th>
                                        <th class="py-4 px-4 w-24">Image</th>
                                        <th class="py-4 px-6">Name</th>
                                        <th class="py-4 px-6 text-center">Price</th>
                                        <th class="py-4 px-6">Category</th>
                                        <th class="py-4 px-6">Description</th>
                                        <th class="py-4 px-6 text-center">Stock</th>
                                        <th class="py-4 px-6 text-center w-36">Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                                    
                                    @foreach ($products as $product)
                                    <tr class="hover:bg-slate-50/70 transition duration-150">
                                        <td class="py-4 px-6 text-center font-medium text-slate-500">{{ $product->id }}</td>
                                        <td class="py-4 px-4">
                                            <div class="w-14 h-14 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 flex items-center justify-center">
                                                <img src="{{ asset('images/p1.webp') }}" alt="{{ $product->name }}">
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-slate-800">{{ $product->name }}</td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="font-bold text-slate-800">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-orange-50 text-orange-600 border border-orange-100">
                                                {{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 max-w-xs truncate text-slate-500">{{ $product->description }}</td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="font-bold text-slate-800">{{ $product->stock }}</span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="#" title="Preview" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('dashboard.products.edit', $product->id) }}" title="Edit" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                </a>
                                                <button title="Delete" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9 9m1.771-5.316A2.225 2.225 0 0 0 14.74 3H9.26a2.225 2.225 0 0 0-1.722 1.282L7.3 5.63m8.904 0a2.225 2.225 0 0 1-2.24 2.24H7.74a2.225 2.225 0 0 1-2.24-2.24m11.168 0H16.3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
