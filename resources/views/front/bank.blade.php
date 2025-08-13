@extends('../layouts.master')
@section('title', 'SADAKAH - Bank Sampah')

@section('content')
<div class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Lokasi Bank Sampah</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">Temukan lokasi bank sampah terdekat di Desa Playen
                untuk memulai perjalanan ramah lingkungan Anda.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('front.bank') }}" method="GET" class="mb-12">
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <!-- Input Pencarian -->
                <div class="w-full sm:w-96 relative">
                    <label for="search" class="sr-only">Cari Lokasi Bank Sampah</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari lokasi bank sampah terdekat di sini..."
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Lokasi 1 -->
            @forelse($lokasiBankSampah as $bank)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-start mb-4">
                    <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-grow">
                        <h4 class="text-lg font-bold text-gray-900 mb-1">{{$bank->name}}</h4>
                        <p class="text-sm text-green-primary font-medium mb-2">Dusun Karangasem</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <p><span class="font-medium">Alamat:</span> {{$bank->address}}</p>
                    <p><span class="font-medium">Jam:</span> {{$bank->operation_hours}}</p>
                    <p><span class="font-medium">Petugas:</span> {{$bank->contact_person}}
                        ({{$bank->phone_number}})</p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-green-primary font-medium">Status: Aktif</span>
                        <a href="{{route('front.bank-detail', $bank)}}">
                            <button class="text-green-primary hover:text-green-dark font-medium">Lihat
                                Detail</button>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                </svg>


                <h3 class="mt-2 text-sm font-medium text-gray-900">Bank Sampah Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection