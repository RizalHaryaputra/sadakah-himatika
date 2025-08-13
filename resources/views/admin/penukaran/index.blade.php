<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Penukaran Poin') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white overflow-hidden rounded-2xl shadow-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Penukaran</h3>
                        <a href="{{ route('admin.penukaran.export') }}">
                            <div
                                class="flex items-center gap-2 bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-600 text-sm font-medium transition duration-300">
                                <svg xmlns="http://www.w.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <p>Ekspor</p>
                            </div>
                        </a>
                    </div>
                    <div class="mb-4">
                        <form action="{{ route('admin.penukaran.index') }}" method="GET">
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
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Nasabah</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Hadiah</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Poin</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Status</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600">Tanggal</th>
                                    <th class="px-4 py-2 text-center font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($penukaranPoin as $index => $penukaran)
                                <tr>
                                    <td class="px-4 py-2">{{ $penukaranPoin->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->transaction_id }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->nasabah->name }}</td>
                                    <td class="px-4 py-2">{{ $penukaran->hadiah->name }} </td>
                                    <td class="px-4 py-2">{{ $penukaran->points_used }} </td>
                                    <td class="px-4 py-2">
                                        @if ($penukaran->status === 'diajukan')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-yellow-800 bg-yellow-100">
                                            Diajukan
                                        </span>
                                        @elseif ($penukaran->status === 'disetujui')
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold text-green-800 bg-green-100">
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
                                    </td>
                                    <td class="px-4 py-2">{{ $penukaran->requested_at }} </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center flex-wrap gap-2">
                                            @if ($penukaran->status === 'diajukan')
                                            <form action="{{ route('admin.penukaran.approve', $penukaran->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button" onclick="showConfirmationPopup(event, 'approve')"
                                                    class=" inline-flex items-center px-4 py-2 bg-green-700 border
                                                    border-transparent rounded-md font-medium text-sm text-white
                                                    hover:bg-green-600 focus:bg-green-700 active:bg-green-700
                                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                    focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.penukaran.reject', $penukaran->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button" onclick="showConfirmationPopup(event, 'reject')"
                                                    class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-medium text-sm text-white hover:bg-red-600 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Tolak
                                                </button>
                                            </form>
                                            @elseif($penukaran->status === 'disetujui')
                                            <form action="{{ route('admin.penukaran.markCollected', $penukaran->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button"
                                                    onclick="showConfirmationPopup(event, 'collected')" class=" inline-flex items-center px-4 py-2 bg-blue-700 border
                                                    border-transparent rounded-md font-medium text-sm text-white
                                                    hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-700
                                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                    focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Diambil
                                                </button>
                                            </form>
                                            @else
                                            <span class="text-gray-500 italic">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">Penukaran tidak ditemukan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $penukaranPoin->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    /**
     * Menampilkan popup konfirmasi SweetAlert2 untuk berbagai aksi.
     * @param {Event} event - Event object dari tombol yang diklik.
     * @param {string} action - Aksi yang akan dilakukan ('approve', 'reject', 'collected').
     */
    function showConfirmationPopup(event, action) {
        // Mencegah form untuk submit secara langsung
        event.preventDefault();

        const form = event.target.closest('form');
        let config = {}; // Objek untuk menampung konfigurasi SweetAlert

        // Mengatur konfigurasi berdasarkan aksi yang dipilih
        switch (action) {
            case 'approve':
                config = {
                    title: "Setujui Permintaan Ini?",
                    text: "Pastikan Anda sudah memeriksa permintaan ini dengan benar.",
                    icon: "success",
                    confirmButtonColor: '#16a34a', // Hijau
                    cancelButtonColor: '#6b7280',  // Abu-abu
                    confirmButtonText: "Ya, Setujui!",
                    input: 'text', // Menambahkan input untuk catatan
                    inputPlaceholder: 'Masukkan catatan (opsional)...'
                };
                break;

            case 'reject':
                config = {
                    title: "Tolak Permintaan Ini?",
                    text: "Poin nasabah akan dikembalikan jika permintaan ditolak.",
                    icon: "warning",
                    confirmButtonColor: '#dc2626', // Merah
                    cancelButtonColor: '#6b7280',  // Abu-abu
                    confirmButtonText: "Ya, Tolak!",
                    input: 'text', // Wajibkan input untuk alasan penolakan
                    inputPlaceholder: 'Masukkan alasan penolakan...',
                    // Menambahkan validasi agar alasan wajib diisi
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Anda harus memberikan alasan penolakan!'
                        }
                    }
                };
                break;

            case 'collected':
                config = {
                    title: "Konfirmasi Pengambilan?",
                    text: "Aksi ini menandakan bahwa hadiah telah diambil oleh nasabah.",
                    icon: "info",
                    confirmButtonColor: '#2563eb', // Biru
                    cancelButtonColor: '#6b7280',  // Abu-abu
                    confirmButtonText: "Ya, Sudah Diambil!"
                    // Tidak ada input field untuk aksi ini
                };
                break;
                
            default:
                // Jika aksi tidak dikenali, jangan lakukan apa-apa
                return;
        }

        // Menambahkan konfigurasi umum ke semua popup
        const finalConfig = {
            ...config, // Menggabungkan konfigurasi spesifik aksi
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: "Batal",
            
        };

        Swal.fire(finalConfig).then((result) => {
            // Jika pengguna menekan tombol konfirmasi
            if (result.isConfirmed) {
                // Cek jika ada nilai dari input field
                if (result.value || result.value === '') {
                    const notes = result.value;

                    // Buat sebuah hidden input untuk menampung nilai catatan
                    const noteInput = document.createElement('input');
                    noteInput.type = 'hidden';
                    noteInput.name = 'notes'; // Sesuaikan dengan nama di controller
                    noteInput.value = notes;

                    // Tambahkan hidden input ke dalam form
                    form.appendChild(noteInput);
                }

                // Submit form secara manual
                form.submit();
            }
        });
    }
</script>