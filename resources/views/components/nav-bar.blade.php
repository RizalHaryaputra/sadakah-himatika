<!-- Navigation -->
<nav class="bg-green-primary shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="SADAKAH Logo" class="h-10 w-10" loading="lazy">
                <span class="ml-3 text-white font-bold text-xl">SADAKAH</span>
            </div>

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

            {{-- Menu links --}}
            <a href="/#beranda" class="nav-link text-white block px-3 py-2 text-base font-medium">Beranda</a>
            <a href="/#tentang" class="nav-link text-white block px-3 py-2 text-base font-medium">Tentang</a>
            <a href="/#produk" class="nav-link text-white block px-3 py-2 text-base font-medium">Produk</a>
            <a href="/#bank-sampah" class="nav-link text-white block px-3 py-2 text-base font-medium">Bank Sampah</a>
            <a href="/#artikel" class="nav-link text-white block px-3 py-2 text-base font-medium">Artikel</a>
            <a href="/#tukar-poin" class="nav-link text-white block px-3 py-2 text-base font-medium">Tukar Poin</a>

            {{-- Tombol login atau logout --}}
            <div class="flex flex-col gap-2 mt-4">
                <a href="{{ route('register') }}">
                    <button
                        class="bg-white text-green-dark border border-green-dark px-4 py-2 rounded-md text-sm font-medium w-full hover:bg-gray-200 transition duration-300">
                        Daftar
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="bg-green-dark text-white px-4 py-2 rounded-md text-sm font-medium w-full hover:bg-green-secondary transition duration-300">
                        Masuk
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>

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