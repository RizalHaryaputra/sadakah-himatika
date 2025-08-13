@extends('../layouts.master')
@section('title', 'SADAKAH - Kategori Sampah')

@section('content')
<div class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Kategori Sampah</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
                Temukan berbagai jenis kategori sampah beserta poin dan deskripsinya.
            </p>
        </div>
        <form action="{{ route('front.category') }}" method="GET" class="mb-12">
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <!-- Input Pencarian -->
                <div class="w-full sm:w-96 relative">
                    <label for="search" class="sr-only">Cari Kategori Sampah</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari kategori sampah di sini..."
                            class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-green-dark focus:border-green-dark placeholder-gray-400"
                            value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Tombol Cari -->
                <div>
                    <button type="submit"
                        class="inline-flex items-center px-6 w-full bg-green-dark text-white py-3 rounded-lg font-semibold hover:bg-green-primary transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($kategoriSampah as $kategori)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $kategori->name }}</h3>
                    <p class="text-gray-600 mb-3">{{ $kategori->description }}</p>
                    <span class="inline-block bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                        {{ number_format($kategori->points_per_kg) }} Poin/Kg
                    </span>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                <h3 class="mt-2 text-sm font-medium text-gray-900">Kategori Sampah Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
            @endforelse
        </div>

        <!-- Paginasi jika diperlukan -->
        <div class="mt-12">
            {{ $kategoriSampah->links() }}
        </div>

    </div>
</div>
@endsection