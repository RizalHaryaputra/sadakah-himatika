@extends('../layouts.master')
@section('title', 'SADAKAH | Daftar')
@section('content')

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 mt-10 py-16 px-4">
    <div class="w-full sm:max-w-md mx-4 sm:mx-0 px-6 py-6 bg-white shadow-lg overflow-hidden rounded-2xl">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-center text-2xl font-bold text-green-primary mb-2">
                    Halaman Daftar
                </h1>
                <x-application-logo />
            </div>

            <!-- Name -->
            <div>
                <x-input-label for=" name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Nomor HP')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                    :value="old('phone_number')" required />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>


            <!-- Padukuhan -->
            <div class="mt-4">
                <x-input-label for="padukuhan_id" :value="__('Padukuhan')" />
                <select id="padukuhan_id" name="padukuhan_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-medium text-sm text-gray-700"
                    required>
                    <option value="">-- Pilih Padukuhan --</option>
                    @foreach($padukuhanPlayen as $padukuhan)
                    <option value="{{ $padukuhan->id }}" {{ old('padukuhan_id')==$padukuhan->id ? 'selected' : '' }}>
                        {{ $padukuhan->name }}
                    </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('padukuhan_id')" class="mt-2" />
            </div>
            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Alamat Lengkap')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Foto Profil (opsional) -->
            <div class="mt-4">
                <x-input-label for="profile_picture" :value="__('Foto Profil (Opsional)')" />
                <input id="profile_picture" type="file" name="profile_picture"
                    class="block mt-1 w-full text-sm text-gray-500 file:bg-gray-800 file:text-white file:rounded file:px-4 file:py-2 file:border-0"
                    accept="image/*">
                <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

@endsection