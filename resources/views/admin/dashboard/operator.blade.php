<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">

            <!-- Info Padukuhan dan Tombol Aksi -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <p class="text-sm text-gray-500">Anda mengelola:</p>
                    <h3 class="text-2xl font-bold text-gray-900">Padukuhan {{ $padukuhanNama }}</h3>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{route('admin.setoran.create')}}">
                        <div
                            class="flex items-center gap-2 bg-gray-800 text-gray-300 px-4 py-2 rounded hover:bg-gray-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>Tambah Setoran Baru</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 shadow-lg rounded-2xl flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Poin Anda</p>
                        <p class="text-2xl font-bold">{{number_format($totalPoin)}}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full"><svg class="w-6 h-6 text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg></div>
                    <div>
                        <p class="text-sm text-gray-500">Total Nasabah</p>
                        <p class="text-2xl font-bold">{{ $totalNasabah }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full"><svg class="w-6 h-6 text-green-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg></div>
                    <div>
                        <p class="text-sm text-gray-500">Total Sampah Terkumpul</p>
                        <p class="text-2xl font-bold">{{ number_format($totalSampahMasuk, 2) }} Kg</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-full"><svg class="w-6 h-6 text-yellow-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18" />
                        </svg></div>
                    <div>
                        <p class="text-sm text-gray-500">Setoran Hari Ini</p>
                        <p class="text-2xl font-bold">{{ $setoranHariIni }}</p>
                    </div>
                </div>
            </div>

            <!-- Grafik dan Tabel -->
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">
                <!-- Grafik Volume Sampah Bulanan -->
                <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-4">Volume Sampah (6 Bulan Terakhir)</h3>
                    <div class="relative h-72">
                        <canvas id="volumeBulananChart"></canvas>
                    </div>
                </div>
                
                <!-- Grafik Komposisi Sampah -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg flex flex-col">
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0">Top 5 Komposisi Sampah</h3>
                    <div class="relative flex-grow">
                        <canvas id="komposisiChart"></canvas>
                    </div>
                </div>
                
                <!-- Grafik Tren Setoran Harian -->
                <div class="lg:col-span-3 bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-4">Jumlah Setoran (7 Hari Terakhir)</h3>
                    <div class="relative h-72">
                        <canvas id="setoranHarianChart"></canvas>
                    </div>
                </div>

                <!-- Tabel Setoran Terbaru -->
                <div class="lg:col-span-3 bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold mb-4">Setoran Terbaru</h3>
                    <div class="overflow-y-auto h-72">
                        <ul class="divide-y divide-gray-200">
                            @forelse ($setoranTerbaru as $setoran)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $setoran->nasabah->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $setoran->kategoriSampah->name }} - {{
                                        $setoran->weight_kg}} Kg</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-green-600">+{{ $setoran->points_earned }} Poin
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $setoran->created_at->diffForHumans() }}</p>
                                </div>
                            </li>
                            @empty
                            <li class="py-4 text-center text-sm text-gray-500">Belum ada setoran terbaru.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    const setoranCtx = document.getElementById('setoranHarianChart').getContext('2d');
        new Chart(setoranCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Setoran',
                    data: @json($chartData),
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Hanya menampilkan angka bulat di sumbu Y
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Grafik Volume Sampah Bulanan (Line Chart)
        const volumeCtx = document.getElementById('volumeBulananChart').getContext('2d');
        new Chart(volumeCtx, {
            type: 'line',
            data: {
                labels: @json($bulananChartLabels),
                datasets: [{
                    label: 'Berat Sampah (Kg)',
                    data: @json($bulananChartData),
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } } 
            }
        });

        // Grafik Komposisi Sampah (Doughnut Chart)
        const komposisiCtx = document.getElementById('komposisiChart').getContext('2d');
        new Chart(komposisiCtx, {
            type: 'pie',
            data: {
                labels: @json($pieChartLabels),
                datasets: [{
                    label: 'Komposisi Sampah (Kg)',
                    data: @json($pieChartData),
                    backgroundColor: ['#1d4ed8', '#16a34a', '#facc15', '#9333ea', '#db2777'],
                    hoverOffset: 4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
</script>