<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Setoran Sampah Baru') }}
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

                <form method="POST" action="{{ route('admin.setoran.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="nasabah_id" :value="__('Nasabah')" />
                        <select id="nasabah_id" name="nasabah_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option value="" disabled selected>-- Pilih nasabah --</option>
                            @foreach($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}" {{ old('nasabah_id')==$nasabah->id ? 'selected' : '' }}>
                                {{ $nasabah->name }} (Email: {{$nasabah->email}}) (Padukuhan: {{ $nasabah->padukuhan->name ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('nasabah_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kategori_sampah_id" :value="__('Kategori Sampah')" />
                        <select id="kategori_sampah_id" name="kategori_sampah_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option value="" disabled selected>-- Pilih kategori sampah --</option>
                            @foreach($kategoriSampah as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_sampah_id')==$kategori->id ? 'selected'
                                : '' }}>
                                {{ $kategori->name }} ({{ $kategori->points_per_kg }} poin/kg)
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kategori_sampah_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="weight_kg" :value="__('Berat Sampah (kg)')" />
                        <x-text-input id="weight_kg" name="weight_kg" type="number" step="0.01"
                            class="mt-1 block w-full" :value="old('weight_kg')" required />
                        <x-input-error :messages="$errors->get('weight_kg')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="collection_date" :value="__('Tanggal Pengumpulan')" />
                        <x-text-input id="collection_date" name="collection_date" type="datetime-local"
                            class="mt-1 block w-full" :value="old('collection_date')" required />
                        <x-input-error :messages="$errors->get('collection_date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="notes" :value="__('Catatan (opsional)')" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.setoran.index') }}"
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