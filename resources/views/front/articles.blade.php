@extends('../layouts.master')
@section('title', 'SADAKAH - Artikel')

@section('content')
<div class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Artikel</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">Jelajahi berbagai artikel menarik tentang sampah dan
                lingkungan.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('front.articles') }}" method="GET" class="mb-12">
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <!-- Input Pencarian -->
                <div class="w-full sm:w-96 relative">
                    <label for="search" class="sr-only">Cari Artikel</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari artikel di sini..."
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
            <!-- Article Card 1 -->
            @forelse($kontenArtikel as $artikel)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="{{asset('storage/' . $artikel->image_url)}}" alt="{{$artikel->title}}"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{$artikel->title}}</h3>
                    <p class="text-gray-600 mb-4">{{$artikel->excerpt}}</p>
                    <a href="{{route('front.article-detail', $artikel)}}"
                        class="text-green-primary hover:underline">Baca Selengkapnya</a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>

                <h3 class="mt-2 text-sm font-medium text-gray-900">Artikel Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
            @endforelse
        </div>

        <!-- Paginasi -->
        <div class="mt-12">
            {{ $kontenArtikel->links() }}
        </div>

    </div>
</div>
@endsection