<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <!-- Kartu Statistik Utama -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
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
                        <p class="text-sm text-gray-500">Total Sampah Masuk</p>
                        <p class="text-2xl font-bold">{{ number_format($totalSampahMasuk, 2) }} Kg</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-full"><svg class="w-6 h-6 text-yellow-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                        </svg></div>
                    <div>
                        <p class="text-sm text-gray-500">Total Transaksi</p>
                        <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Poin Beredar</p>
                        <p class="text-2xl font-bold">{{ number_format($poinBeredar) }}</p>
                    </div>
                </div>
            </div>

            <!-- Grafik dan Aktivitas -->
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">
                <!-- Kolom Kiri: Grafik Volume Sampah -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg flex flex-col">
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0">Volume Sampah Masuk - 6 Bulan Terakhir
                    </h3>
                    <div class="relative flex-grow">
                        <canvas id="volumeChart"></canvas>
                    </div>
                </div>

                <!-- Kolom Tengah: Komposisi Sampah -->   
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg flex flex-col">
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0">Top 5 Komposisi Sampah</h3>
                    <div class="relative flex-grow">
                        <canvas id="komposisiChart"></canvas>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg flex flex-col">
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0">Volume Sampah Masuk per Padukuhan</h3>
                    </h3>
                    <div class="relative flex-grow">
                        <canvas id="padukuhanChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Tabel Aktivitas Terbaru -->
            <div class="mt-6 bg-white overflow-hidden rounded-2xl shadow-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Permintaan Penukaran Menunggu Persetujuan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">No</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">ID</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Nasabah</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Hadiah</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Poin</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Tanggal</th>
                                    <th class="px-4 py-2 text-center font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($penukaranMenunggu as $penukaran)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->transaction_id }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->nasabah->name }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->hadiah->name }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->points_used }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->requested_at }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('admin.penukaran.index') }}"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada permintaan
                                        penukaran yang menunggu persetujuan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    // Grafik Volume Sampah (Line Chart)
        const volumeCtx = document.getElementById('volumeChart').getContext('2d');
        new Chart(volumeCtx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Berat Sampah (Kg)',
                    data: @json($chartData),
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } }, maintainAspectRatio: false}
        });

        // Grafik Komposisi Sampah (Pie Chart)
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
            options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' }} }
        });

        const padukuhanCtx = document.getElementById('padukuhanChart').getContext('2d');
        new Chart(padukuhanCtx, {
            type: 'bar',
            data: {
                labels: @json($padukuhanChartLabels),
                datasets: [{
                    label: 'Berat Sampah (Kg)',
                    data: @json($padukuhanChartData),
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } }, maintainAspectRatio: false}
        });

</script>