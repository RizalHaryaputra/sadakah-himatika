<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Riwayat Penukaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Daftar Riwayat Penukaran Poin</h3>
                    </div>
                    <div class="mb-4">
                        <form action="{{ route('admin.riwayat-penukaran') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Cari berdasarkan id penukaran..."
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
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">ID</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Hadiah</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Poin</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Status</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Tanggal</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Catatan</th>
                                    <th class="px-4 py-2 text-center font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($penukaranPoin as $index => $penukaran)
                                <tr>
                                    <td class="px-4 py-2">{{ $penukaranPoin->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->transaction_id }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->hadiah->name }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->points_used }}</td>
                                    <td class="px-4 py-2">
                                        @if ($penukaran->status === 'diajukan')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-yellow-800 bg-yellow-100">Diajukan</span>
                                        @elseif ($penukaran->status === 'disetujui')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-green-800 bg-green-100">Disetujui</span>
                                        @elseif ($penukaran->status === 'ditolak')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-red-800 bg-red-100">Ditolak</span>
                                        @elseif ($penukaran->status === 'diambil')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-blue-800 bg-blue-100">Diambil</span>
                                        @endif

                                    </td>
                                    <td class="px-4 py-2">{{ $penukaran->requested_at }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->notes ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        @if ($penukaran->status === 'diajukan')
                                        <form action="{{ route('nasabah.cancel-penukaran', $penukaran->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-700 text-white px-4 py-2 rounded-md text-sm hover:bg-red-600 transition">
                                                Batalkan
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-500 italic">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">Penukaran
                                        poin tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $penukaranPoin->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>