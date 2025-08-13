<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">

            {{-- Pesan Selamat Datang --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-800">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                </div>
            </div>

            {{-- Kartu Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                {{-- Card 1: Total Poin/Nasabah --}}
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

                {{-- Card 2: Sampah Terkumpul --}}
                <div class="bg-white p-6 shadow-lg rounded-2xl flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Sampah Terkumpul</p>
                        <p class="text-2xl font-bold">{{$totalBerat}} Kg</p> {{-- Ganti dengan data asli --}}
                    </div>
                </div>

                {{-- Card 3: Jumlah Setoran --}}
                <div class="bg-white p-6 shadow-lg rounded-2xl flex items-center space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Setoran</p>
                        <p class="text-2xl font-bold">{{$totalSetoran}} Kali</p>
                    </div>
                </div>

                {{-- Card 4: Jumlah Penukaran --}}
                <div class="bg-white p-6 shadow-lg rounded-2xl flex items-center space-x-4">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Penukaran</p>
                        <p class="text-2xl font-bold">{{$totalPenukaran}} Kali</p> {{-- Ganti dengan data asli --}}
                    </div>
                </div>
            </div>

            {{-- Grafik dan Aktivitas Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Kolom Kiri: Grafik Tren Setoran --}}
                <div class="lg:col-span-1 bg-white p-6 shadow-lg rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">Tren Setoran Sampah (Kg)</h3>
                    <canvas id="setoranChart"></canvas>
                </div>

                {{-- Kolom Setoran Terbaru --}}
                <div class="bg-white p-6 shadow-lg rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">Setoran Terbaru</h3>
                    <div class="space-y-4">
                        {{-- Item Setoran --}}
                        @forelse ($setoranTerbaru as $setoran)
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Kategori: {{$setoran->kategoriSampah->name}}
                                    ({{$setoran->weight_kg}} Kg)</p>
                                <p class="text-xs text-gray-500">+ {{$setoran->points_earned}} Poin</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">Tidak ada setoran terbaru.</p>
                        @endforelse

                        @if ($setoranTerbaru->count() > 0)
                        <a href="{{route('nasabah.riwayat-setoran')}}"
                            class="text-sm text-blue-600 hover:underline mt-4 inline-block">Lihat semua
                            setoran</a>
                        @endif
                    </div>
                </div>

                {{-- Kolom Penukaran Terbaru --}}
                <div class="bg-white p-6 shadow-lg rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">Penukaran Terbaru</h3>
                    <div class="space-y-4">
                        {{-- Item Penukaran --}}
                        @forelse ($penukaranTerbaru as $penukaran)
                        <div class="flex items-center space-x-3">
                            <div class="bg-red-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Hadiah: {{$penukaran->hadiah->name}} ({{$penukaran->points_used}} poin)</p>
                                @if ($penukaran->status === 'diajukan')
                                <span class="px-2 py-1 rounded text-xs font-semibold text-yellow-800 bg-yellow-100">
                                    Diajukan
                                </span>
                                @elseif ($penukaran->status === 'disetujui')
                                <span class="px-2 py-1 rounded text-xs font-semibold text-green-800 bg-green-100">
                                    Disetujui
                                </span>
                                @elseif ($penukaran->status === 'ditolak')
                                <span class="px-2 py-1 rounded text-xs font-semibold text-red-800 bg-red-100">
                                    Ditolak
                                </span>
                                @elseif ($penukaran->status === 'diambil')
                                <span class="px-2 py-1 rounded text-xs font-semibold text-blue-800 bg-blue-100">
                                    Diambil
                                </span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">Tidak ada penukaran terbaru.</p>
                        @endforelse
                        @if ($penukaranTerbaru->count() > 0)
                        <a href="{{route('nasabah.riwayat-penukaran')}}"
                            class="text-sm text-blue-600 hover:underline mt-4 inline-block">Lihat semua
                            penukaran</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('setoranChart').getContext('2d');
            
            // Data dummy untuk grafik. Ganti dengan data dari controller Anda.
            const labels = @json($chartLabels);
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Berat Sampah (Kg)',
                    data: @json($chartData),
                    backgroundColor: 'rgba(22, 163, 74, 0.2)',
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 2,
                    tension: 0.4, // Membuat garis lebih melengkung
                    fill: true
                }]
            };

            new Chart(ctx, {
                type: 'line', // Tipe grafik (line, bar, pie, dll)
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false// Sembunyikan legenda jika tidak perlu
                        }
                    }
                }
            });
        });   
</script>