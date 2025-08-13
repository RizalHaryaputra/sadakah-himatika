@extends('../layouts.master')
@section('title', 'SADAKAH - Hadiah')

@section('content')
<div class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Hadiah</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">Jelajahi berbagai hadiah menarik yang dapat Anda
                tukar</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('front.rewards') }}" method="GET" class="mb-12">
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <!-- Input Pencarian -->
                <div class="w-full sm:w-96 relative">
                    <label for="search" class="sr-only">Cari Hadiah</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari hadiah di sini..."
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

        <!-- Grid Hadiah -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Reward Card 1 -->
            @forelse($hadiahPoin as $hadiah)
            <div class="bg-green-light bg-opacity-20 rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{$hadiah->name}}</h3>
                <p class="text-green
-primary text-2xl font-bold mb-4">{{$hadiah->point_cost}} Poin</p>
                <p class="text-gray-600 mb-4">{{$hadiah->description}}</p>
                <form action="{{ route('front.redemption-request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="hadiah_id" value="{{$hadiah->id}}">
                    @if(!Auth::check())
                    <button type="submit"
                        class="bg-green-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Tukar Sekarang
                    </button>
                    @elseif(Auth::user()->total_poin < $hadiah->point_cost)
                        <button type="button"
                            class="bg-gray-300 text-gray-600 px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                            Poin Tidak Cukup
                        </button>
                        @elseif(Auth::user()->total_poin >= $hadiah->point_cost)
                        <button type="submit"
                            class="bg-green-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-secondary transition duration-300">
                            Tukar Sekarang
                        </button>
                        @endif
                </form>

            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>

                <h3 class="mt-2 text-sm font-medium text-gray-900">Hadiah Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
            </div>
            @endforelse
        </div>

        <!-- Paginasi -->
        <div class="mt-12">
            {{ $hadiahPoin->links() }}
        </div>

    </div>
</div>
@endsection