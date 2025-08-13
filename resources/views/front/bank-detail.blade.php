{{-- resources/views/front/bank-detail.blade.php --}}

@extends('../layouts.master')
@section('title', $bank->name . ' - Bank Sampah')

@section('content')
<div class="bg-gray-50 mt-12">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $bank->name }}</h1>
            <p class="mt-2 max-w-2xl mx-auto text-lg text-gray-600">{{ $bank->address }}</p>
            
            {{-- <nav class="flex justify-center mt-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('front.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-dark">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            <a href="{{ route('front.bank') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-green-dark md:ml-2">Bank Sampah</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav> --}}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-96 mb-8">
                    {{-- Menggunakan {!! !!} untuk merender tag <iframe> dari database dengan aman --}}
                    {!! $bank->maps_embed !!}
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi & Informasi</h4>
                    {{-- Kelas 'prose' akan menata teks dari deskripsi secara otomatis --}}
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($bank->description)) !!}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="space-y-6 top-24">
                    <div class="bg-gradient-to-br from-green-primary to-green-dark rounded-2xl p-8 text-white shadow-xl">
                        <h3 class="text-2xl font-bold mb-6 border-b border-white/20 pb-4">Informasi Utama</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                <div>
                                    <p class="font-semibold">Alamat Lengkap</p>
                                    <p class="opacity-90 leading-relaxed">{{ $bank->address }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                                <div>
                                    <p class="font-semibold">Jam Operasional</p>
                                    <p class="opacity-90">{{ $bank->operation_hours }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                                <div>
                                    <p class="font-semibold">Narahubung ({{ $bank->contact_person }})</p>
                                    <p class="opacity-90 hover:opacity-100">{{ $bank->phone_number }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('front.bank') }}" class="w-full inline-block px-6 py-3 bg-white border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-100 transition duration-300">
                            &larr; Kembali ke Direktori
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection