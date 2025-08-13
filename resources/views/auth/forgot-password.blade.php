@extends('../layouts.master')
@section('title', 'Sadakah | Lupa Kata Sandi')
@section('content')

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 mt-10 py-16 px-4">
    <div class="w-full sm:max-w-md mx-4 sm:mx-0 px-6 py-6 bg-white shadow-lg overflow-hidden rounded-2xl">
        <div class="mb-4 text-sm text-gray-600 text-justify">
            {{ __('Lupa kata sandi? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan
            tautan untuk mereset kata sandi yang akan memungkinkan Anda memilih yang baru.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Kirim') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection