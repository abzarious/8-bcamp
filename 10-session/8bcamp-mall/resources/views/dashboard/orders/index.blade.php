<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Orders (Pesanan Masuk)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 text-sm font-medium border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200 text-sm font-semibold text-gray-700">
                                <th class="p-4">Customer</th>
                                <th class="p-4">Produk</th>
                                <th class="p-4">Total Pembayaran</th>
                                <th class="p-4">Bukti Transfer</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $order->user->name ?? 'User Terhapus' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $order->product->name ?? 'Produk Terhapus' }}</div>
                                        <div class="text-xs text-gray-500">Jumlah: {{ $order->quantity }} pcs</div>
                                    </td>
                                    <td class="p-4 font-semibold text-orange-600">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="p-4">
                                        @if($order->payment_proof)
                                            <div class="flex flex-col gap-1">
                                                <span class="text-xs text-green-600 font-bold">✓ Sudah Upload</span>
                                                <a href="{{ asset('images/' . $order->payment_proof) }}" target="_blank" class="text-blue-600 hover:underline text-xs font-semibold">
                                                    Lihat Bukti Transfer
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded font-medium italic">Belum bayar</span>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <span class="px-2.5 py-1 text-xs font-bold rounded-full 
                                            {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                            {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $order->status === 'shipped' ? 'bg-green-100 text-green-800' : '' }} uppercase tracking-wide">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('dashboard.orders.update_status', $order->id) }}" method="POST" class="inline-flex items-center gap-2 m-0">
                                            @csrf
                                            <select name="status" class="text-xs border-gray-300 rounded focus:ring-orange-500 focus:border-orange-500 py-1 px-2 text-gray-700">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing (Dikemas)</option>
                                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
                                            </select>
                                            <button type="submit" class="bg-gray-800 hover:bg-black text-white text-xs px-2.5 py-1 rounded transition-colors cursor-pointer font-medium">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-400">
                                        Belum ada data transaksi/pesanan masuk dari customer.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>