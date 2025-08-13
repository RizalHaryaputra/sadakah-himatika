<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- DASHBOARD (untuk semua role admin/operator) --}}
                    @role('Super Admin')
                    <x-nav-link :href="route('admin.dashboard-admin')"
                        :active="request()->routeIs('admin.dashboard-admin')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endrole
                    @role('Operator Padukuhan')
                    <x-nav-link :href="route('admin.dashboard-operator')"
                        :active="request()->routeIs('admin.dashboard-operator')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endrole
                    @role('Nasabah')
                    <x-nav-link :href="route('nasabah.dashboard')" :active="request()->routeIs('nasabah.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endrole

                    {{-- DROPDOWN MANAJEMEN DATA (KHUSUS SUPER ADMIN) --}}
                    @role('Super Admin')
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                @php
                                // Cek apakah ada route manajemen data yang sedang aktif
                                $isManajemenDataActive = request()->routeIs('admin.kategori.*') ||
                                request()->routeIs('admin.artikel.*') || request()->routeIs('admin.produk.*') ||
                                request()->routeIs('admin.bank.*') || request()->routeIs('admin.hadiah.*') ||
                                request()->routeIs('admin.penukaran.*') || request()->routeIs('admin.pengguna.*') ||
                                request()->routeIs('admin.setoran.*');
                                @endphp
                                <button
                                    class="h-full inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ $isManajemenDataActive ? ' font-semibold text-gray-900 focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300' }}">
                                    <div>Kelola Data</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.pengguna.index')"
                                    :active="request()->routeIs('admin.pengguna.*')"> {{ __('Pengguna') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.kategori.index')"
                                    :active="request()->routeIs('admin.kategori.*')"> {{ __('Kategori Sampah') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.artikel.index')"
                                    :active="request()->routeIs('admin.artikel.*')"> {{ __('Artikel') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.produk.index')"
                                    :active="request()->routeIs('admin.produk.*')"> {{ __('Produk Kerajinan') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.bank.index')"
                                    :active="request()->routeIs('admin.bank.*')"> {{ __('Bank Sampah') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.hadiah.index')"
                                    :active="request()->routeIs('admin.hadiah.*')"> {{ __('Hadiah') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.penukaran.index')"
                                    :active="request()->routeIs('admin.penukaran.*')"> {{ __('Penukaran Poin') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.setoran.index')"
                                    :active="request()->routeIs('admin.setoran.*')"> {{ __('Setoran Sampah') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endrole

                    {{-- MENU STANDALONE (OPERATOR) --}}
                    @hasanyrole('Operator Padukuhan')
                    <x-nav-link :href="route('admin.pengguna.index')" :active="request()->routeIs('admin.pengguna.*')">
                        {{ __('Pengguna') }}
                    </x-nav-link>
                    @endhasanyrole

                    {{-- MENU SETORAN (KHUSUS OPERATOR) --}}
                    @role('Operator Padukuhan')
                    <x-nav-link :href="route('admin.setoran.index')" :active="request()->routeIs('admin.setoran.*')">
                        {{ __('Setoran Sampah') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.riwayat-penukaran')" :active="request()->routeIs('admin.riwayat-penukaran')">
                        {{ __('Riwayat Penukaran') }}
                    </x-nav-link>
                    @endrole

                    {{-- MENU NASABAH --}}
                    @role('Nasabah')
                    <x-nav-link :href="route('nasabah.riwayat-setoran')"
                        :active="request()->routeIs('nasabah.riwayat-setoran')">
                        {{ __('Riwayat Setoran') }}
                    </x-nav-link>
                    <x-nav-link :href="route('nasabah.riwayat-penukaran')"
                        :active="request()->routeIs('nasabah.riwayat-penukaran')">
                        {{ __('Riwayat Penukaran') }}
                    </x-nav-link>
                    @endrole
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @role('Nasabah')
                        <x-dropdown-link :href="route('nasabah.profile')"> {{ __('Profil') }} </x-dropdown-link>
                        @endrole
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- DASHBOARD (RESPONSIVE) --}}
            @role('Super Admin')
            <x-responsive-nav-link :href="route('admin.dashboard-admin')"
                :active="request()->routeIs('admin.dashboard-admin')"> {{ __('Dashboard') }} </x-responsive-nav-link>
            @endrole
            @role('Operator Padukuhan')
            <x-responsive-nav-link :href="route('admin.dashboard-operator')"
                :active="request()->routeIs('admin.dashboard-operator')"> {{ __('Dashboard') }} </x-responsive-nav-link>
            @endrole
            @role('Nasabah')
            <x-responsive-nav-link :href="route('nasabah.dashboard')" :active="request()->routeIs('nasabah.dashboard')">
                {{ __('Dashboard') }} </x-responsive-nav-link>
            @endrole
        </div>

        {{-- MENU NASABAH (RESPONSIVE) --}}
        @role('Nasabah')
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">Menu Nasabah</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('nasabah.riwayat-setoran')"
                    :active="request()->routeIs('nasabah.riwayat-setoran')"> {{ __('Riwayat Setoran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('nasabah.riwayat-penukaran')"
                    :active="request()->routeIs('nasabah.riwayat-penukaran')"> {{ __('Riwayat Penukaran') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endrole


        {{-- MANAJEMEN DATA (RESPONSIVE - SUPER ADMIN) --}}
        @role('Super Admin')
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">Kelola Data</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.pengguna.index')"
                    :active="request()->routeIs('admin.pengguna.*')"> {{ __('Pengguna') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kategori.index')"
                    :active="request()->routeIs('admin.kategori.*')"> {{ __('Kategori Sampah') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.artikel.index')"
                    :active="request()->routeIs('admin.artikel.*')"> {{ __('Artikel') }} </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.produk.index')"
                    :active="request()->routeIs('admin.produk.*')"> {{ __('Produk Kerajinan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.bank.index')" :active="request()->routeIs('admin.bank.*')">
                    {{ __('Bank Sampah') }} </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.hadiah.index')"
                    :active="request()->routeIs('admin.hadiah.*')"> {{ __('Hadiah') }} </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.penukaran.index')"
                    :active="request()->routeIs('admin.penukaran.*')"> {{ __('Penukaran Poin') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endrole

        {{-- MANAJEMEN OPERASIONAL (RESPONSIVE - OPERATOR) --}}
        @role('Operator Padukuhan')
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">Manajemen Operasional</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.pengguna.index')"
                    :active="request()->routeIs('admin.pengguna.*')"> {{ __('Pengguna') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.setoran.index')"
                    :active="request()->routeIs('admin.setoran.*')"> {{ __('Setoran Sampah') }} </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.riwayat-penukaran')"
                    :active="request()->routeIs('admin.riwayat-penukaran')"> {{ __('Riwayat Penukaran') }} </x-responsive-nav-link>
            </div>
        </div>
        @endrole

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                @role('Nasabah')
                <x-responsive-nav-link :href="route('nasabah.profile')"> {{ __('Profil Saya') }}
                </x-responsive-nav-link>
                @endrole
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>