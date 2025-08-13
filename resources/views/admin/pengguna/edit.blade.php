<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengguna') }}</span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                {{-- Menampilkan pesan error validasi --}}
                @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.pengguna.update', $pengguna) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        {{-- Gunakan old() sebagai fallback untuk value --}}
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $pengguna->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $pengguna->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            {{-- Beri catatan bahwa password opsional --}}
                            <x-input-label for="password" :value="__('Password Baru (opsional)')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Peran (Role)')" />
                        <select id="role" name="role"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            {{-- Ambil role yang sudah ada dari relasi --}}
                            @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $pengguna->roles->first()->name ?? '') == $role ?
                                'selected' : '' }}>
                                {{ $role }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="padukuhan_id" :value="__('Padukuhan (Opsional, untuk Nasabah/Operator)')" />
                        <select id="padukuhan_id" name="padukuhan_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Tidak Ada</option>
                            @foreach($padukuhan as $id => $nama)
                            <option value="{{ $id }}" {{ old('padukuhan_id', $pengguna->padukuhan_id) == $id ? 'selected' :
                                '' }}>
                                {{ $nama }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('padukuhan_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone_number" :value="__('Nomor Telepon (opsional)')" />
                        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                            :value="old('phone_number', $pengguna->phone_number)" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Alamat (opsional)')" />
                        <textarea id="address" name="address" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', $pengguna->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="profile_picture" :value="__('Ganti Foto Profil (opsional)')" />
                        {{-- Preview Image --}}
                        <div class="mt-4">
                            <img id="preview" src="{{asset('storage/' . $pengguna->profile_picture)}}" alt="{{$pengguna->name}}" class="w-10 h-10 object-cover rounded shadow" />
                        </div>
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="block mt-1 w-full text-sm text-gray-500 file:bg-gray-800 file:text-white file:rounded file:px-4 file:py-2 file:border-0" />
                        <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.pengguna.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-medium text-sm text-white tracking-widest hover:bg-red-600 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>