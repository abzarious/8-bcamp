<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories View') }}
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
                                <h3 class="text-lg font-bold text-slate-800">Daftar Kategori Produk</h3>
                                <p class="text-sm text-slate-500">Kelola semua kategori produk yang tersedia di Hachi Mall</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/10 transition active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Kategori Produk
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-slate-150">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-slate-50 text-slate-600 text-xs font-bold uppercase tracking-wider border-b border-slate-200">
                                        <th class="py-4 px-6 text-center w-12">Id</th>
                                        <th class="py-4 px-6">Name</th>
                                        <th class="py-4 px-6">Slug</th>
                                        <th class="py-4 px-6 text-center w-36">Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                                    
                                    @foreach ($categories as $category)
                                    <tr class="hover:bg-slate-50/70 transition duration-150">
                                        <td class="py-4 px-6 text-center font-medium text-slate-500">{{ $category->id }}</td>
                                        <td class="py-4 px-6 font-semibold text-slate-800">{{ $category->name }}</td>
                                        <td class="py-4 px-6 max-w-xs truncate text-slate-500">{{ $category->slug }}</td>
                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="#" title="Edit" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition duration-150">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
