<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Setoran') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Riwayat Setoran</h3>
                    </div>
                    <div class="mb-4">
                        <form action="{{ route('nasabah.riwayat-setoran') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Cari berdasarkan tanggal setoran..."
                                    class="w-full md:w-1/3 border-gray-300 rounded-l-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    value="{{ request('search') }}">
                                <button type="submit"
                                    class="px-4 py-2 bg-gray-800 border border-gray-800 text-gray-300 rounded-r-lg hover:bg-gray-700 hover:border-gray-700 text-sm">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">No</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Kategori</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Berat/Kg</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Poin</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Tanggal</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($setoranSampah as $index => $setoran)
                                <tr>
                                    <td class="px-4 py-2">{{ $setoranSampah->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $setoran->kategoriSampah->name }} </td>
                                    <td class="px-4 py-2">{{ $setoran->weight_kg }} </td>
                                    <td class="px-4 py-2">{{ $setoran->points_earned }} </td>
                                    <td class="px-4 py-2">{{ $setoran->collection_date }} </td>
                                    <td class="px-4 py-2">{{ optional($setoran)->notes ?? '-' }} </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Riwayat
                                        setoran tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $setoranSampah->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>