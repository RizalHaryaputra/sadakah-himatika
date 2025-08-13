@extends('../layouts.master')
@section('title', 'SADAKAH - Galeri Produk Kerajinan')

@section('content')
<div class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Galeri Produk Kerajinan</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">Jelajahi berbagai produk unik hasil daur ulang yang
                ramah lingkungan.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('front.products') }}" method="GET" class="mb-12">
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <!-- Input Pencarian -->
                <div class="w-full sm:w-96 relative">
                    <label for="search" class="sr-only">Cari Produk</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari produk terbaikmu di sini..."
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



        <!-- Grid Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($produkKerajinan as $produk)
            <div
                class="group relative bg-white rounded-2xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                <div class="w-full h-48 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $produk->image_url) }}" alt="{{$produk->name}}"
                        class="w-full h-full object-cover object-center">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2"">
                        <a href=" #">{{$produk->name}}</a>
                    </h3>
                    <p class="text-2xl font-bold text-green-primary mb-4">Rp{{ number_format($produk->price) }}</p>
                    <p class="text-gray-600 mb-6 text-sm overflow-hidden">Penjual: <span class="font-semibold">{{
                            $produk->seller_name }}</span>
                    </p>
                    <div class="flex flex-col gap-3 mb-3">
                        @php
                        // Format nomor WhatsApp (pastikan nomor di database diawali 62)
                        $waNumber = preg_replace('/^0/', '62', $produk->whatsapp_number);
                        // Buat pesan default yang akan diisi otomatis di WhatsApp
                        $waMessage = "Halo, saya tertarik dengan produk '" . $produk->name . "' seharga Rp " .
                        number_format($produk->price, 0, ',', '.') . ". Apakah produk ini masih tersedia?";
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ rawurlencode($waMessage) }}" target="_blank"
                            class="w-full inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-green-dark hover:bg-green-primary transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-dark">
                            <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.487 5.235 3.487 8.413 0 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.687-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.447-4.435-9.884-9.888-9.884-5.448 0-9.886 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.203 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Beli via WhatsApp
                        </a>
                        <a href="{{ route('front.product-detail', $produk) }}">
                            <button
                                class="w-full inline-block px-6 py-3 bg-white border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-100 transition duration-300">
                                Lihat Detail
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Produk Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
            @endforelse
        </div>

        <!-- Paginasi -->
        <div class="mt-12">
            {{ $produkKerajinan->links() }}
        </div>

    </div>
</div>
@endsection