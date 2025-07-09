<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SADAKAH - Sampah Dadi Berkah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'green-primary': '#7A9A65',
                        'green-secondary': '#8DB675',
                        'green-dark': '#5A7A4A',
                        'green-light': '#B8D1A0',
                    }
                }
            }
        }
    </script>
    <style>
        .hero-bg {
            background: linear-gradient(rgba(122, 154, 101, 0.8), rgba(122, 154, 101, 0.8)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 600"><rect fill="%23f0f0f0" width="1000" height="600"/><circle fill="%23ddd" cx="200" cy="150" r="80"/><circle fill="%23bbb" cx="800" cy="400" r="120"/><rect fill="%23ccc" x="300" y="200" width="400" height="200" rx="20"/></svg>');
            background-size: cover;
            background-position: center;
        }

        .stat-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #B8D1A0;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-green-primary shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="SADAKAH Logo" class="h-10 w-10">
                    <span class="ml-3 text-white font-bold text-xl">SADAKAH</span>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#beranda"
                            class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#tentang"
                            class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                        <a href="#produk"
                            class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Produk</a>
                        <a href="#bank-sampah" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Bank
                            Sampah</a>
                        <a href="#artikel"
                            class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Artikel</a>
                        <a href="#tukar-poin" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Tukar
                            Poin</a>
                    </div>
                </div>

                <div class="hidden md:block">
                    <a href="{{route('login')}}">
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
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#beranda" class="nav-link text-white block px-3 py-2 text-base font-medium">Beranda</a>
                <a href="#tentang" class="nav-link text-white block px-3 py-2 text-base font-medium">Tentang</a>
                <a href="#produk" class="nav-link text-white block px-3 py-2 text-base font-medium">Produk</a>
                <a href="#bank-sampah" class="nav-link text-white block px-3 py-2 text-base font-medium">Bank Sampah</a>
                <a href="#artikel" class="nav-link text-white block px-3 py-2 text-base font-medium">Artikel</a>
                <a href="#tukar-poin" class="nav-link text-white block px-3 py-2 text-base font-medium">Tukar Poin</a>
                <a href="{{route('login')}}">
                    <button class="bg-green-dark text-white px-4 py-2 rounded-md text-sm font-medium w-full mt-2">
                        Masuk
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-bg min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Selamat Datang di Rumah<br>
                    Sampah Digital SADAKAH
                </h1>
                <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto">
                    Kami hadir untuk membantu masyarakat mengelola sampah dengan lebih bijak melalui sistem bank sampah
                    digital
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{route('register')}}">
                        <button
                            class="bg-green-dark text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                            Daftar Sekarang
                        </button>
                    </a>
                    <a href="#tentang">
                        <button
                            class="border-2 border-white text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-white hover:text-green-primary transition duration-300">
                            Pelajari Lebih Lanjut
                        </button>
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">32 Kg</div>
                    <div class="text-gray-600 font-medium">Sampah dikumpulkan</div>
                </div>
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">10.8K</div>
                    <div class="text-gray-600 font-medium">Pengguna</div>
                </div>
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">54.3K</div>
                    <div class="text-gray-600 font-medium">Koin ditukar</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tentang SADAKAH</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    SADAKAH (Sampah Dadi Berkah) adalah platform digital yang menghubungkan masyarakat dengan sistem
                    pengelolaan sampah yang efektif dan berkelanjutan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Digitalisasi Pencatatan</h3>
                                <p class="text-gray-600">Sistem pencatatan setoran sampah yang digital dan transparan
                                    untuk memudahkan nasabah memantau kontribusi mereka.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sistem Poin Transparan</h3>
                                <p class="text-gray-600">Setiap setoran sampah dihargai dengan poin yang dapat ditukar
                                    dengan berbagai hadiah sembako.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Marketplace Kerajinan</h3>
                                <p class="text-gray-600">Platform untuk memasarkan produk kerajinan hasil daur ulang
                                    sampah dari mitra kami.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-green-light bg-opacity-20 rounded-2xl p-8">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 bg-green-primary rounded-full mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('images/logo.png') }}" alt="SADAKAH Logo" class="h-32 w-32">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rumah Sampah Digital SADAKAH</h3>
                        <p class="text-gray-600 mb-6">
                            Bermitra dengan Rumah Sampah Digital SADAKAH untuk memberikan solusi pengelolaan sampah yang
                            berkelanjutan bagi masyarakat.
                        </p>
                        {{-- <div class="bg-white rounded-lg p-4 text-sm text-gray-600">
                            <strong>1 Poin = Rp 1.000</strong><br>
                            Sistem konversi yang mudah dipahami
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produk" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Produk Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Koleksi kerajinan berkualitas tinggi hasil daur ulang sampah yang dibuat dengan penuh kreativitas
                    oleh mitra kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1 -->
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.X_tg9yf3SN0o7Qcnu7YzPAHaEL&pid=Api&P=0&h=220">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Kerajinan A</h3>
                        <p class="text-2xl font-bold text-green-primary mb-4">Rp 120.000</p>
                        <p class="text-gray-600 mb-6 text-sm">Kerajinan unik dari bahan daur ulang dengan kualitas
                            premium dan desain menarik.</p>
                        <button
                            class="w-full bg-green-dark text-white py-3 rounded-lg font-semibold hover:bg-green-primary transition duration-300">
                            Beli
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.QOkvS6qJoiaFcqLj7Xdb7gHaEK&pid=Api&P=0&h=220">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Kerajinan B</h3>
                        <p class="text-2xl font-bold text-green-primary mb-4">Rp 150.000</p>
                        <p class="text-gray-600 mb-6 text-sm">Produk ramah lingkungan dengan sentuhan modern yang cocok
                            untuk dekorasi rumah.</p>
                        <button
                            class="w-full bg-green-dark text-white py-3 rounded-lg font-semibold hover:bg-green-primary transition duration-300">
                            Beli
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img src="https://tse2.mm.bing.net/th?id=OIP.zjiqcPmVO5zo52fxJfBUfAHaEK&pid=Api&P=0&h=220">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Kerajinan C</h3>
                        <p class="text-2xl font-bold text-green-primary mb-4">Rp 120.000</p>
                        <p class="text-gray-600 mb-6 text-sm">Inovasi kreatif dari sampah yang diubah menjadi barang
                            berguna dan bernilai tinggi.</p>
                        <button
                            class="w-full bg-green-dark text-white py-3 rounded-lg font-semibold hover:bg-green-primary transition duration-300">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button
                    class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                    Lihat Semua Produk
                </button>
            </div>
        </div>
    </section>

    <!-- Bank Sampah Section -->
    <section id="bank-sampah" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Sistem Bank Sampah</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kelola sampah Anda dengan mudah dan dapatkan keuntungan melalui sistem poin yang transparan.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="bg-green-light bg-opacity-20 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Cara Kerja</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-green-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    1</div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900">Daftar sebagai Nasabah</h4>
                                    <p class="text-gray-600">Buat akun dan lengkapi profil Anda untuk mulai menggunakan
                                        layanan.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-green-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    2</div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900">Setorkan Sampah</h4>
                                    <p class="text-gray-600">Bawa sampah Anda ke Rumah Sampah untuk ditimbang dan
                                        dicatat.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-green-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    3</div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900">Dapatkan Poin</h4>
                                    <p class="text-gray-600">Setiap kilogram sampah dihitung otomatis menjadi poin di
                                        akun Anda.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-green-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    4</div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-900">Tukar dengan Hadiah</h4>
                                    <p class="text-gray-600">Tukarkan poin Anda dengan berbagai sembako dan kebutuhan
                                        sehari-hari.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gradient-to-r from-green-primary to-green-secondary rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Kategori Sampah</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">Plastik</div>
                                <div class="text-sm opacity-80">Botol, kemasan, dll</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">Kertas</div>
                                <div class="text-sm opacity-80">Koran, karton, dll</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">Logam</div>
                                <div class="text-sm opacity-80">Kaleng, besi, dll</div>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">Kaca</div>
                                <div class="text-sm opacity-80">Botol kaca, dll</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border-2 border-green-light rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Keuntungan Bergabung</h3>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Dapatkan poin untuk setiap setoran sampah</span>
                            </li>
                            <li class="flex items

                                <svg class=" w-5 h-5 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Tukar poin dengan sembako dan hadiah menarik</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Partisipasi dalam program lingkungan yang berkelanjutan</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Komunitas yang peduli lingkungan dan saling mendukung</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Lokasi Bank Sampah Section -->
    <section id="lokasi" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Lokasi Bank Sampah</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Temukan lokasi bank sampah terdekat di Desa Playen untuk memulai perjalanan ramah lingkungan Anda.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Peta -->
                <div class="order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-96">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15801.123456789!2d110.123456!3d-7.8765432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPlayen%2C%20Gunungkidul!5e0!3m2!1sen!2sid!4v1234567890123"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                
                <!-- Info Utama -->
                <div class="order-1 lg:order-2 space-y-6">
                    <div class="bg-gradient-to-r from-green-primary to-green-secondary rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">Rumah Sampah Utama</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold">Alamat:</p>
                                    <p class="opacity-90">Jl. Raya Playen No. 45, Desa Playen, Gunungkidul, DIY</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold">Jam Operasional:</p>
                                    <p class="opacity-90">Senin - Sabtu: 08:00 - 16:00 WIB</p>
                                    <p class="opacity-90">Minggu: Tutup</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold">Kontak:</p>
                                    <p class="opacity-90">+62 812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-light">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Fasilitas Tersedia</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Timbangan Digital
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Area Sortir
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Tempat Parkir
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                WiFi Gratis
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lokasi Bank Sampah Lainnya -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Lokasi Bank Sampah Lainnya di Desa Playen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Lokasi 1 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 01</h4>
                                <p class="text-sm text-green-primary font-medium mb-2">Dusun Karangasem</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Karangasem No. 12, RT 01/RW 01</p>
                            <p><span class="font-medium">Jam:</span> Selasa & Jumat, 14:00-17:00</p>
                            <p><span class="font-medium">Petugas:</span> Bu Sari (0812-1111-2222)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-green-primary font-medium">Status: Aktif</span>
                                <button class="text-green-primary hover:text-green-dark font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi 2 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 03</h4>
                                <p class="text-sm text-green-primary font-medium mb-2">Dusun Wonogiri</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Wonogiri No. 8, RT 03/RW 02</p>
                            <p><span class="font-medium">Jam:</span> Senin & Kamis, 15:00-18:00</p>
                            <p><span class="font-medium">Petugas:</span> Pak Budi (0812-3333-4444)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-green-primary font-medium">Status: Aktif</span>
                                <button class="text-green-primary hover:text-green-dark font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi 3 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 05</h4>
                                <p class="text-sm text-green-primary font-medium mb-2">Dusun Grogol</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Grogol No. 25, RT 05/RW 03</p>
                            <p><span class="font-medium">Jam:</span> Rabu & Sabtu, 13:00-16:00</p>
                            <p><span class="font-medium">Petugas:</span> Bu Ratna (0812-5555-6666)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-green-primary font-medium">Status: Aktif</span>
                                <button class="text-green-primary hover:text-green-dark font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi 4 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 07</h4>
                                <p class="text-sm text-green-primary font-medium mb-2">Dusun Kedungsari</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Kedungsari No. 33, RT 07/RW 04</p>
                            <p><span class="font-medium">Jam:</span> Selasa & Sabtu, 14:30-17:30</p>
                            <p><span class="font-medium">Petugas:</span> Pak Joko (0812-7777-8888)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-green-primary font-medium">Status: Aktif</span>
                                <button class="text-green-primary hover:text-green-dark font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi 5 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 09</h4>
                                <p class="text-sm text-green-primary font-medium mb-2">Dusun Pucung</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Pucung No. 17, RT 09/RW 05</p>
                            <p><span class="font-medium">Jam:</span> Senin & Jumat, 15:30-18:30</p>
                            <p><span class="font-medium">Petugas:</span> Bu Ningsih (0812-9999-0000)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-green-primary font-medium">Status: Aktif</span>
                                <button class="text-green-primary hover:text-green-dark font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi 6 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pos Sampah RT 11</h4>
                                <p class="text-sm text-yellow-600 font-medium mb-2">Dusun Bleberan</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Alamat:</span> Jl. Bleberan No. 41, RT 11/RW 06</p>
                            <p><span class="font-medium">Jam:</span> Kamis & Minggu, 14:00-17:00</p>
                            <p><span class="font-medium">Petugas:</span> Pak Surono (0812-1010-1111)</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-yellow-600 font-medium">Status: Dalam Perbaikan</span>
                                <button class="text-gray-400 cursor-not-allowed font-medium">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Info Tambahan -->
            <div class="bg-gradient-to-r from-green-primary to-green-secondary rounded-2xl p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Ingin Membuka Pos Sampah Baru?</h3>
                <p class="text-lg mb-6 opacity-90">
                    Jika komunitas Anda tertarik untuk membuka pos sampah baru di RT/RW masing-masing, 
                    silakan hubungi tim koordinator kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-green-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Hubungi Koordinator
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-primary transition duration-300">
                        Download Panduan
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Articles Section -->
    <section id="artikel" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Artikel Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dapatkan informasi dan tips seputar pengelolaan sampah, daur ulang, dan keberlanjutan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Article Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.5gdg9XRhlk6YcGDDdG0rrAHaE8&pid=Api&P=0&h=220"
                        alt="Artikel 1" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mengapa Daur Ulang Penting?</h3>
                        <p class="text-gray-600 mb-4">Daur ulang membantu mengurangi limbah dan menjaga lingkungan tetap
                            bersih.</p>
                        <a href="#" class="text-green-primary hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>

                <!-- Article Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.8ClO1Y76VJPLIJC564XqoAHaE0&pid=Api&P=0&h=220"
                        alt="Artikel 2" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tips Mengurangi Sampah Plastik</h3>
                        <p class="text-gray-600 mb-4">Beberapa cara sederhana untuk mengurangi penggunaan plastik dalam
                            kehidupan sehari-hari.</p>
                        <a href="#" class="text-green-primary hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>

                <!-- Article Card 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.UbtbCwrgZ9sIjk9-MK2RkgHaE8&pid=Api&P=0&h=220"
                        alt="Artikel 3" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Inovasi Daur Ulang Terbaru</h3>
                        <p class="text-gray-600 mb-4">Teknologi terbaru dalam daur ulang yang dapat membantu mengurangi
                            limbah.</p>
                        <a href="#" class="text-green-primary hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <button
                    class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                    Lihat Semua Artikel
                </button>
            </div>
        </div>
    </section>
    <!-- Tukar Poin Section -->
    <section id="tukar-poin" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tukar Poin Anda</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tukarkan poin yang telah Anda kumpulkan dengan berbagai hadiah menarik dan sembako.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Reward Card 1 -->
                <div class="bg-green-light bg-opacity-20 rounded-lg p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Paket Sembako</h3>
                    <p class="text-green
-primary text-2xl font-bold mb-4">100 Poin</p>
                    <p class="text-gray-600 mb-4">Dapatkan paket sembako lengkap untuk kebutuhan sehari-hari.</p>
                    <button
                        class="bg-green-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Tukar Sekarang
                    </button>
                </div>

                <!-- Reward Card 2 -->
                <div class="bg-green-light bg-opacity-20 rounded-lg p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Voucher Belanja</h3>
                    <p class="text-green
-primary text-2xl font-bold mb-4">200 Poin</p>

                    <p class="text-gray-600 mb-4">Voucher belanja untuk berbagai kebutuhan di toko mitra kami.</p>
                    <button
                        class="bg-green-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Tukar Sekarang
                    </button>
                </div>

                <!-- Reward Card 3 -->
                <div class="bg-green-light bg-opacity-20 rounded-lg p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk Kerajinan</h3>
                    <p class="text-green
-primary text-2xl font-bold mb-4">300 Poin</p>
                    <p class="text-gray-600 mb-4">Tukar poin Anda dengan produk kerajinan unik hasil daur ulang.</p>
                    <button
                        class="bg-green-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Tukar Sekarang
                    </button>
                </div>
            </div>
            <div class="text-center mt-12">
                <button
                    class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                    Lihat Semua Hadiah
                </button>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-green-primary text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-6 md:mb-0">
                    <h3 class="text-2xl font-bold">SADAKAH</h3>
                    <p class="mt-2">Sampah Dadi Berkah</p>
                </div>
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                    <a href="#beranda" class="text-white hover:text-green-secondary transition duration-300">Beranda</a>
                    <a href="#tentang" class="text-white hover:text-green-secondary transition duration-300">Tentang</a>
                    <a href="#produk" class="text-white hover:text-green-secondary transition duration-300">Produk</a>
                    <a href="#bank-sampah" class="text-white hover:text-green-secondary transition duration-300">Bank
                        Sampah</a>
                    <a href="#artikel" class="text-white hover:text-green-secondary transition duration-300">Artikel</a>
                    <a href="#tukar-poin" class="text-white hover:text-green-secondary transition duration-300">Tukar
                        Poin</a>
                </div>
            </div>
            <div class="mt-8 text-center">
                <p class="text-sm">&copy; 2025 SADAKAH. All rights reserved.</p>
            </div>
        </div>
    </footer>
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
</body>

</html>