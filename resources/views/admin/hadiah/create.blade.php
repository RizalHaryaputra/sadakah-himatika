<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Hadiah') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <form method="POST" action="{{ route('admin.hadiah.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Hadiah -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Hadiah')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Biaya Poin -->
                    <div class="mb-4">
                        <x-input-label for="point_cost" :value="__('Biaya Poin')" />
                        <x-text-input id="point_cost" name="point_cost" type="number" min="0" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('point_cost')" class="mt-2" />
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <x-input-label for="stock" :value="__('Stok Hadiah')" />
                        <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <x-input-label for="image_url" :value="__('Gambar (opsional)')" />
                        <input type="file" id="image_url" name="image_url" accept="image/*"
                            class="block mt-1 w-full text-sm text-gray-500 file:bg-gray-800 file:text-white file:rounded file:px-4 file:py-2 file:border-0" />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>

                    <!-- Status Aktif -->
                    <div class="mb-4">
                        <x-input-label for="is_active" :value="__('Status Hadiah')" />
                        <select id="is_active" name="is_active" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.hadiah.index') }}"
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
