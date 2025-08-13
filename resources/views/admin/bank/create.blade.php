<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Bank Sampah') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <form method="POST" action="{{ route('admin.bank.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Bank Sampah')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Jam Operasional -->
                    <div class="mb-4">
                        <x-input-label for="operation_hours" :value="__('Jam Operasional (opsional)')" />
                        <x-text-input id="operation_hours" name="operation_hours" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('operation_hours')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Alamat Lengkap')" />
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Google Maps Embed (opsional) -->
                    <div class="mb-4">
                        <x-input-label for="maps_embed" :value="__('Embed Google Maps (opsional)')" />
                        <textarea id="maps_embed" name="maps_embed" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('maps_embed')" class="mt-2" />
                    </div>

                    <!-- Kontak -->
                    <div class="mb-4">
                        <x-input-label for="contact_person" :value="__('Kontak Person (opsional)')" />
                        <x-text-input id="contact_person" name="contact_person" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
                    </div>

                    <!-- Nomor HP -->
                    <div class="mb-4">
                        <x-input-label for="phone_number" :value="__('Nomor HP (opsional)')" />
                        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <x-input-label for="image_url" :value="__('Gambar (opsional)')" />
                        <input id="image_url" name="image_url" type="file" accept="image/*"
                            class="block mt-1 w-full text-sm text-gray-500 file:bg-gray-800 file:text-white file:rounded file:px-4 file:py-2 file:border-0" />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.bank.index') }}"
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
