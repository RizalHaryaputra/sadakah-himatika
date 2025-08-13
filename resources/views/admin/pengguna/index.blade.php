<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden rounded-2xl shadow-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Pengguna</h3>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.pengguna.export', request()->query()) }}"
                                class="flex items-center gap-2 bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-600 text-sm font-medium transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <p>Ekspor</p>
                            </a>

                            @role('Super Admin')
                            <a href="{{route('admin.pengguna.create')}}">
                                <div
                                    class="flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-sm font-medium transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p>Tambah</p>
                                </div>
                            </a>
                            @endrole
                        </div>
                    </div>
                    <div class="mb-4">
                        <form action="{{ route('admin.pengguna.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Cari berdasarkan nama atau email..."
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
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Nama</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Foto</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Email</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Alamat</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Padukuhan</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Poin</th>
                                    @role('Super Admin')
                                    <th class="px-4 py-2 text-center font-medium text-gray-600">Aksi</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($users as $index => $pengguna)
                                <tr>
                                    <td class="px-4 py-2">{{ $users->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $pengguna->name }}</td>
                                    <td class="px-4 py-2">
                                        <img src="{{ asset('storage/'. $pengguna->profile_picture) }}"
                                            alt="{{ $pengguna->name }}" class="w-10 h-10 object-cover rounded">
                                    </td>
                                    <td class="px-4 py-2">{{ $pengguna->email }}</td>
                                    <td class="px-4 py-2">{{ $pengguna->address }}</td>
                                    <td class="px-4 py-2">{{ optional($pengguna->padukuhan)->name ?? '-' }} </td>
                                    <td class="px-4 py-2">{{ $pengguna->total_poin }} </td>
                                    @role('Super Admin')
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{route('admin.pengguna.edit', $pengguna)}}" title="Edit"
                                                class="text-gray-700 hover:text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{route('admin.pengguna.destroy', $pengguna)}}" method="POST"
                                                id="formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" title="Hapus" onclick="confirmDelete(this)"
                                                    class="text-gray-700 hover:text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">Pengguna tidak ditemukan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(button) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b91c1c',
        cancelButtonColor: '#1F2937',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit(); // submit form terdekat
        }
    });
}
</script>