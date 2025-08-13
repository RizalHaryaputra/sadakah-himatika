{{-- resources/views/front/product-detail.blade.php --}}

@extends('../layouts.master')
@section('title', $produk->name . ' - SADAKAH')

@section('content')
<div class="bg-gray-100 mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        {{-- <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('front.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-dark">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('front.products') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-green-dark md:ml-2">Galeri</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($produk->name, 20)
                            }}</span>
                    </div>
                </li>
            </ol>
        </nav> --}}

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Detail Produk</h1>
            <p class="mt-2 max-w-2xl mx-auto text-lg text-gray-600">Jelajahi lebih detail produk favorit kamu di sini</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            <div class="w-full">
                <div class="aspect-w-1 aspect-h-1 w-full bg-gray-100 rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $produk->image_url) }}" alt="{{ $produk->name }}"
                        class="w-full h-full object-cover object-center">
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $produk->name }}</h1>

                    <div class="border-b-2 border-gray-200">
                        <div class="mt-3 flex items-center>
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="size-6">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-md text-gray-600">Penjual: <span class="font-semibold">{{
                                    $produk->seller_name }}</span></p>
                        </div>
                    <p class="text-4xl font-bold text-green-primary my-4">Rp{{ number_format($produk->price)
                        }}</p>
                    </div>


                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
                        {{-- Kelas 'prose' dari Tailwind Typography akan menata HTML dari deskripsi secara otomatis --}}
                        <div class="prose prose-sm max-w-none prose-green text-justify text-gray-600">
                            {!! $produk->description !!}
                        </div>
                    </div>
                </div>

                <div class="mt-10">
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
                        Hubungi Penjual via WhatsApp
                    </a>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('front.products') }}"
                        class="w-full inline-block px-6 py-3 bg-white border border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-100 transition duration-300">
                        &larr; Kembali ke Galeri Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection