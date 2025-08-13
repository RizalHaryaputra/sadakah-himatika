{{-- resources/views/front/article-detail.blade.php --}}

@extends('../layouts.master')
@section('title', $artikel->title . ' - SADAKAH')

@section('content')
<div class="bg-gray-50 mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        {{--
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('front.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-dark">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('front.articles') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-green-dark md:ml-2">Artikel</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($artikel->title, 30)
                            }}</span>
                    </div>
                </li>
            </ol>
        </nav> --}}

        <!-- Layout Utama: Konten Artikel & Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            <!-- Kolom Utama (Konten Artikel) -->
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-lg">
                <!-- Gambar Utama Artikel -->
                <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200 rounded-xl overflow-hidden mb-8">
                    <img src="{{ asset('storage/' . $artikel->image_url) }}" alt="{{ $artikel->title }}"
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Judul dan Meta Info -->
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight leading-tight">{{ $artikel->title }}</h1>
                <div class="mt-4 flex items-center space-x-6 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Oleh: <span class="font-semibold">{{ $artikel->author_name }}</span></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ $artikel->published_at }}</span>
                    </div>
                </div>

                <!-- Garis Pemisah -->
                <hr class="my-8">

                <!-- Isi Konten Artikel -->
                {{-- Kelas 'prose' dari Tailwind Typography akan menata konten dari editor secara otomatis --}}
                <div class="prose prose-sm max-w-none prose-green text-justify">
                    {!! $artikel->content !!}
                </div>

                <!-- Garis Pemisah -->
                <hr class="my-8">

                <!-- Tombol Berbagi -->
                <div class="flex items-center">
                    <span class="text-sm font-semibold text-gray-700 mr-4">Bagikan Artikel:</span>
                    <div class="flex space-x-2">
                        @php
                        $currentUrl = url()->current();
                        $shareText = "Baca artikel menarik: " . $artikel->title;
                        @endphp
                        {{-- WhatsApp --}}
                        <a href="https://api.whatsapp.com/send?text={{ rawurlencode($shareText . ' ' . $currentUrl) }}"
                            target="_blank"
                            class="w-10 h-10 bg-[#25D366] rounded-full flex items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.487 5.235 3.487 8.413 0 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.687-1.448l-6.305 1.654z" />
                            </svg>
                        </a>
                        {{-- Twitter --}}
                        <a href="https://twitter.com/intent/tweet?url={{ rawurlencode($currentUrl) }}&text={{ rawurlencode($shareText) }}"
                            target="_blank"
                            class="w-10 h-10 bg-[#1DA1F2] rounded-full flex items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616v.064c0 2.297 1.634 4.208 3.803 4.649-.625.17-1.284.26-1.96.26-.306 0-.6-.028-.891-.086.608 1.881 2.372 3.247 4.465 3.283-1.786 1.394-4.049 2.224-6.517 2.224-.423 0-.84-.023-1.254-.074 2.305 1.476 5.038 2.336 7.982 2.336 9.574 0 14.801-7.94 14.801-14.801 0-.226-.005-.452-.015-.676.982-.713 1.832-1.604 2.516-2.608z" />
                            </svg>
                        </a>
                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($currentUrl) }}"
                            target="_blank"
                            class="w-10 h-10 bg-[#4267B2] rounded-full flex items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <!-- Penulis -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                        <img class="w-24 h-24 rounded-full mx-auto -mt-12 border-4 border-white"
                            src="{{ $artikel->inputBy->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($artikel->author_name).'&color=7F9CF5&background=EBF4FF' }}"
                            alt="Avatar penulis">
                        <h3 class="mt-4 text-xl font-bold text-gray-900">{{ $artikel->author_name }}</h3>
                        <p class="text-sm text-gray-500">Penulis Artikel</p>
                    </div>

                    <!-- Artikel Terbaru -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-3">Artikel Terbaru</h3>
                        <div class="space-y-4">
                            @forelse($recentArticles as $recent)
                            <a href="{{ route('front.article-detail', $recent->slug) }}" class="block group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-20 h-20 bg-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('storage/' . $recent->image_url) }}"
                                            alt="{{ $recent->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4
                                            class="text-md font-semibold text-gray-800 group-hover:text-green-dark transition">
                                            {{ $recent->title }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $recent->published_at}}</p>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p class="text-sm text-gray-500">Tidak ada artikel lain.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('front.articles') }}"
                            class="w-full inline-block px-6 py-3 bg-white border border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-100 transition duration-300">
                            &larr; Kembali ke Halaman Artikel
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection