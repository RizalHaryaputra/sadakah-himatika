<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('before-styles')
    @vite('resources/css/app.css')
    <style>
        .ck-content ul,
        .ck-content ol {
            list-style-type: disc;
            /* atau decimal untuk <ol> */
            padding-left: 1.5rem;
            /* tambahkan indentasi */
            margin-bottom: 1rem;
        }

        .ck-content ol {
            list-style-type: decimal;
        }

        .ck-content li {
            margin-bottom: 0.25rem;
        }

        .ck-content h1 {
            font-size: 1.875rem;
            /* 30px */
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            line-height: 1.2;
        }

        .ck-content h2 {
            font-size: 1.5rem;
            /* 24px */
            font-weight: 600;
            margin-bottom: 0.75rem;
            margin-top: 1.25rem;
            line-height: 1.3;
        }

        .ck-content h3 {
            font-size: 1.25rem;
            /* 20px */
            font-weight: 600;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
            line-height: 1.3;
        }
    </style>
    @stack('after-styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <!-- CSS for carousel/flickity-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    {{-- FilePond CSS --}}
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
</head>
<!-- Navigation -->
<nav class="bg-green-primary shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{route('front.index')}}">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="SADAKAH Logo" class="h-10 w-10">
                    <span class="ml-3 text-white font-bold text-xl">SADAKAH</span>
                </div>
            </a>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/#beranda" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="/#tentang" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                    <a href="/#produk" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Produk</a>
                    <a href="/#bank-sampah" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Bank
                        Sampah</a>
                    <a href="/#artikel" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Artikel</a>
                    <a href="/#tukar-poin" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Tukar
                        Poin</a>
                </div>
            </div>

            @if(Auth::check())
            <div class="hidden md:flex items-center gap-4">
                <div class="text-right leading-tight">
                    <p class="text-sm text-white font-semibold">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-300">
                        {{ number_format(Auth::user()->total_poin) }} poin
                    </p>
                </div>

                @role('Nasabah')
                <a href="{{route('nasabah.dashboard')}}" class="relative group">
                    <div
                        class="w-10 h-10 rounded-full overflow-hidden border-2 border-white group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                @endrole

                @role('Super Admin')
                <a href="{{ route('admin.dashboard-admin') }}" class="relative group">
                    <div
                        class="w-10 h-10 rounded-full overflow-hidden border-2 border-white group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                @endrole

                @role('Operator Padukuhan')
                <a href="{{ route('admin.dashboard-operator') }}" class="relative group">
                    <div
                        class="w-10 h-10 rounded-full overflow-hidden border-2 border-white group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                @endrole
            </div>

            @else

            <div class="hidden md:flex gap-2">
                <a href="{{ route('register') }}">
                    <button
                        class="bg-white text-green-dark px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-200 transition duration-300">
                        Daftar
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button
                        class="bg-green-dark text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-secondary transition duration-300">
                        Masuk
                    </button>
                </a>
            </div>
            @endif

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-green-primary">
        <div class="px-4 pt-4 pb-6 space-y-1">

            {{-- Info user jika sudah login --}}
            @if(Auth::check())

            @role('Nasabah')
            <div class="flex items-center gap-3 mb-4">
                <a href="{{route('nasabah.dashboard')}}" class="relative group">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                        <img src="{{ asset('storage/'. Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                <div class="text-white">
                    <p class="text-sm font-semibold leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-200">{{ number_format(Auth::user()->total_poin) }} poin</p>
                </div>
            </div>
            @endrole

            @role('Super Admin')
            <div class="flex items-center gap-3 mb-4">
                <a href="{{route('admin.dashboard-admin')}}" class="relative group">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                        <img src="{{ asset('storage/'. Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                <div class="text-white">
                    <p class="text-sm font-semibold leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-200">{{ number_format(Auth::user()->total_poin) }} poin</p>
                </div>
            </div>
            @endrole

            @role('Operator Padukuhan')
            <div class="flex items-center gap-3 mb-4">
                <a href="{{route('admin.dashboard-operator')}}" class="relative group">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                        <img src="{{ asset('storage/'. Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                <div class="text-white">
                    <p class="text-sm font-semibold leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-200">{{ number_format(Auth::user()->total_poin) }} poin</p>
                </div>
            </div>
            @endrole


            @endif

            {{-- Menu links --}}
            <a href="/#beranda" class="nav-link text-white block px-3 py-2 text-base font-medium">Beranda</a>
            <a href="/#tentang" class="nav-link text-white block px-3 py-2 text-base font-medium">Tentang</a>
            <a href="/#produk" class="nav-link text-white block px-3 py-2 text-base font-medium">Produk</a>
            <a href="/#bank-sampah" class="nav-link text-white block px-3 py-2 text-base font-medium">Bank
                Sampah</a>
            <a href="/#artikel" class="nav-link text-white block px-3 py-2 text-base font-medium">Artikel</a>
            <a href="/#tukar-poin" class="nav-link text-white block px-3 py-2 text-base font-medium">Tukar Poin</a>

            {{-- Tombol login atau logout --}}
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-800 text-white px-4 py-2 rounded-md text-sm font-medium w-full mt-3">
                    Keluar
                </button>
            </form>
            @else
            <div class="flex flex-col gap-2 mt-4">
                <a href="{{ route('register') }}">
                    <button
                        class="bg-white text-green-dark border border-green-dark px-4 py-2 rounded-md text-sm font-medium w-full hover:bg-gray-200 transition duration-300">
                        Daftar
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button
                        class="bg-green-dark text-white px-4 py-2 rounded-md text-sm font-medium w-full hover:bg-green-secondary transition duration-300">
                        Masuk
                    </button>
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>

@yield('content')

{{-- FilePond JS --}}
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>


<!-- Footer -->
<footer class="bg-green-primary text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-center md:text-left mb-6 md:mb-0">
                <h3 class="text-2xl font-bold">SADAKAH</h3>
                <p class="mt-2">Sampah Dadi Berkah</p>
            </div>
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                <a href="/#beranda" class="text-white hover:text-green-secondary transition duration-300">Beranda</a>
                <a href="/#tentang" class="text-white hover:text-green-secondary transition duration-300">Tentang</a>
                <a href="/#produk" class="text-white hover:text-green-secondary transition duration-300">Produk</a>
                <a href="/#bank-sampah" class="text-white hover:text-green-secondary transition duration-300">Bank
                    Sampah</a>
                <a href="/#artikel" class="text-white hover:text-green-secondary transition duration-300">Artikel</a>
                <a href="/#tukar-poin" class="text-white hover:text-green-secondary transition duration-300">Tukar
                    Poin</a>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p class="text-sm">&copy; 2025 SADAKAH. All rights reserved.</p>
        </div>
    </div>
</footer>
@stack('before-scripts')

@stack('after-scripts')

@include('sweetalert2::index')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>

<script>
    function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu.classList.contains('hidden')) return;
                    mobileMenu.classList.add('hidden');
                });
            });
        }); 
</script>