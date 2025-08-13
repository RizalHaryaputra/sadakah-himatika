@extends('../layouts.master')
@section('title', 'SADAKAH - Sampah Dadi Berkah')
@section('content')

<body class="bg-gray-50">

    <!-- Hero Section -->
    <section id="beranda"
        class="relative min-h-screen flex items-center py-20 sm:py-24 md:pt-16 md:pb-20 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/bg-hero.png') }}');">

        <!-- Overlay gelap -->
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        {{-- Content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
            <div class="text-center mb-12">
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Selamat Datang<br>
                    di Rumah Sampah Digital 'SADAKAH'
                </h1>
                <p class="text-base sm:text-lg md:text-2xl text-white mb-8 max-w-3xl mx-auto">
                    Kami hadir untuk membantu masyarakat mengelola sampah dengan lebih bijak melalui sistem bank sampah
                    digital
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}">
                        <button
                            class="bg-green-dark text-white px-8 py-3 rounded-lg text-base sm:text-lg font-semibold hover:bg-green-secondary transition duration-300">
                            Daftar Sekarang
                        </button>
                    </a>
                    <a href="#tentang">
                        <button
                            class="border-2 border-white text-white px-8 py-3 rounded-lg text-base sm:text-lg font-semibold hover:bg-white hover:text-green-primary transition duration-300">
                            Pelajari Lebih Lanjut
                        </button>
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">
                        {{number_format($totalSampahMasuk)}} Kg</div>
                    <div class="text-gray-600 font-medium">Sampah dikumpulkan</div>
                </div>
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">{{$totalNasabah}}</div>
                    <div class="text-gray-600 font-medium">Pengguna</div>
                </div>
                <div class="stat-card bg-white bg-opacity-90 backdrop-blur-md rounded-xl p-6 text-center">
                    <div class="text-3xl md:text-4xl font-bold text-green-primary mb-2">{{number_format($poinBeredar)}}
                    </div>
                    <div class="text-gray-600 font-medium">Poin Beredar</div>
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
                                <svg class="text-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Digitalisasi Pencatatan</h3>
                                <p class="text-gray-600">Sistem pencatatan setoran sampah yang digital dan transparan
                                    untuk memudahkan nasabah memantau setoran sampah.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center">
                                <svg class="text-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
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
                                <svg class="text-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
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
                @forelse ($produkKerajinan as $produk)
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $produk->image_url) }}" alt="{{$produk->name}}"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{$produk->name}}</h3>
                        <p class="text-2xl font-bold text-green-primary mb-4">Rp{{ number_format($produk->price) }}</p>
                        <p class="text-gray-600 mb-6 text-sm">Penjual: <span class="font-semibold">{{
                                $produk->seller_name }}</p>
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
                <div class="col-span-3 text-center">
                    <p class="text-gray-600">Tidak ada produk kerajinan yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('front.products') }}">
                    <button
                        class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Lihat Semua Produk
                    </button>
                </a>
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
                            @forelse($kategoriSampah as $kategori)
                            <div class="bg-white bg-opacity-20 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold">{{$kategori->name}}</div>
                                <div class="text-sm opacity-80">{{$kategori->points_per_kg}} Poin/Kg</div>
                            </div>
                            @empty
                            <div class="text-center">
                                <p class="text-gray-600">Tidak ada kategori sampah saat ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('front.category') }}"
                            class="w-full inline-block px-6 py-3 bg-white border border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-100 transition duration-300">
                            Lihat Semua Kategori Sampah
                        </a>
                    </div>
                    {{-- <div class="bg-white border-2 border-green-light rounded-2xl p-8">
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
                    </div> --}}
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Lokasi 1 -->
                @forelse($lokasiBankSampah as $bank)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <div class="flex items-start mb-4">
                        <div
                            class="w-12 h-12 bg-green-primary rounded-lg flex items-center justify-center flex-shrink-0">
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
                <div class="col-span-3 text-center">
                    <p class="text-gray-600">Tidak ada lokasi bank sampah lainnya saat ini.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('front.bank') }}">
                    <button
                        class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Lihat Semua Bank Sampah
                    </button>
                </a>
            </div>

            <!-- Info Tambahan -->
            <div
                class="bg-gradient-to-r from-green-primary to-green-secondary rounded-2xl p-8 text-white text-center mt-12">
                @php
                $waMessage = "Hallo Admin, saya ingin mengunggah Artikel atau Produk Olahan Sampah"
                @endphp
                <h3 class="text-2xl font-bold mb-4">Ingin Mengunggah Artikel atau Produk Olahan Sampah Baru?</h3>
                <p class="text-lg mb-6 opacity-90">
                    Jika Anda tertarik untuk mengunggah artikel/berita seputar pengolahan sampah atau memasarkan produk
                    olahan sampah pada website SADAKAH, silakan hubungi Admin kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/+6287855038324?text={{ rawurlencode($waMessage) }}" target="_blank">
                        <button
                            class="bg-white text-green-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Hubungi Admin
                        </button>
                    </a>
                    <button
                        class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-primary transition duration-300">
                        Syarat dan Ketentuan
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
                    Dapatkan informasi seputar kegiatan PPK Ormawa HIMATIKA FMIPA UNY 2025 dan tips seputar pengolahan
                    serta pengelolaan sampah organik dan anorganik.
                </p>
            </div>

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
                <div class="p-6">
                    <p class="text-gray-600">Tidak ada artikel terbaru saat ini.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('front.articles') }}">
                    <button
                        class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Lihat Semua Artikel
                    </button>
                </a>
            </div>
        </div>
    </section>
    <!-- Tukar Poin Section -->
    <section id="tukar-poin" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tukar Poin Anda</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tukarkan poin yang telah Anda kumpulkan dengan sembako dan uang tunai.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Reward Card 1 -->
                @forelse($hadiahPoin as $hadiah)
                <div class="bg-green-light bg-opacity-20 rounded-lg p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{$hadiah->name}}</h3>
                    <p class="text-green
-primary text-2xl font-bold mb-4">{{ number_format($hadiah->point_cost, 0,
                        ',', '.') }} Poin</p>
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
                <div class="p-6">
                    <p class="text-gray-600">Tidak ada hadiah terbaru saat ini.</p>
                </div>
                @endforelse

            </div>
            <div class="text-center mt-12">
                <a href="{{ route('front.rewards') }}">
                    <button
                        class="bg-green-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-secondary transition duration-300">
                        Lihat Semua Hadiah
                    </button>
                </a>
            </div>
        </div>
    </section>

</body>
@endsection


@push('before-styles')
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
@endpush

@push('before-scripts')
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
@endpush