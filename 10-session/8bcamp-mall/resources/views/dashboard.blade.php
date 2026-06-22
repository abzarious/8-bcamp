<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                    @foreach ($totals_data as $total)
                        <div class="{{ $total['bg_color'] }} p-5 rounded-lg flex justify-between items-center shadow-sm">
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 uppercase tracking-wider">{{ $total['name'] }}</h3>
                                <h2 class="text-3xl font-bold text-gray-900 mt-1">
                                    @switch($total['name'])
                                        @case('User')
                                            {{ $jumlahUser }}
                                            @break
                                        @case('Product')
                                            {{ $jumlahProduk }}
                                            @break
                                        @case('Product Category')
                                            {{ $jumlahKategori }}
                                            @break
                                        @case('Product Clicks')
                                            {{ $jumlahKlikProduk }}
                                            @break
                                        @default
                                            {{ $total['total'] }}
                                    @endswitch
                                </h2>
                            </div>

                            <div class="text-4xl text-gray-800 opacity-70">
                                <i class="bi {{ $total['icon'] }}"></i>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm-rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Weekly Order & Revenue</h3>
                <div class="w-full" style="height: 400px;">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 
    bg-blue-200 
    bg-green-200 
    bg-yellow-200
    bg-red-200  
    bg-purple-200  
    -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Konversi data dari PHP array ke JavaScript Object JSON
            const rawData = @json($weekly_order_data);

            // Ekstrak data untuk sumbu X dan Y
            const labels = rawData.map(item => item.date);
            const dataOrder = rawData.map(item => item.total_order);
            const dataRevenue = rawData.map(item => item.revenue);

            const ctx = document.getElementById('weeklyChart').getContext('2d');
            
            new Chart(ctx, {
                data: {
                    labels: labels,
                    datasets: [
                        {
                            type: 'bar', // Total Order berbentuk Batang (Bar)
                            label: 'Total Order',
                            data: dataOrder,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            yAxisID: 'yOrder', // Pakai sumbu Y sebelah kiri
                        },
                        {
                            type: 'line', // Revenue berbentuk Garis (Line)
                            label: 'Revenue (Rp)',
                            data: dataRevenue,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 3,
                            tension: 0.3, // Membuat garis sedikit melengkung halus
                            yAxisID: 'yRevenue', // Pakai sumbu Y sebelah kanan
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yOrder: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Jumlah Order'
                            },
                            grid: {
                                drawOnChartArea: true, // Garis grid utama pakai skala ini
                            },
                        },
                        yRevenue: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Pendapatan (Rupiah)'
                            },
                            grid: {
                                drawOnChartArea: false, // Biar grid-nya tidak tabrakan dengan yOrder
                            },
                        }
                    }
                }
            });
        });
    </script>
@endpush
</x-app-layout>
