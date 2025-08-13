<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Sampah') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <form method="POST" action="{{route('admin.kategori.store')}}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Kategori')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Price per kg -->
                    {{-- <div class="mb-4">
                        <x-input-label for="price_per_kg" :value="__('Harga per Kg (opsional)')" />
                        <x-input-error :messages="$errors->get('price_per_kg')" class="mt-2" />
                    </div> --}}

                    <x-text-input id="price_per_kg" name="price_per_kg" type="hidden" step="0.01"
                        class="mt-1 block w-full" />
                        
                    <!-- Points per kg -->
                    <div class="mb-4">
                        <x-input-label for="points_per_kg" :value="__('Poin per Kg')" />
                        <x-text-input id="points_per_kg" name="points_per_kg" type="number" min="0"
                            class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('points_per_kg')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.kategori.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-medium text-sm text-white tracking-widest hover:bg-red-600 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Kembali</a>
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>