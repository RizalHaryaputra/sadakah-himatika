<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Artikel') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                {{-- Jika validasi error, ini penting hehe --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{route('admin.artikel.store')}}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Judul Artikel')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required
                            autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Author -->
                    <div class="mb-4">
                        <x-input-label for="author_name" :value="__('Nama Penulis')" />
                        <x-text-input id="author_name" name="author_name" type="text" class="mt-1 block w-full"
                            required />
                        <x-input-error :messages="$errors->get('author_name')" class="mt-2" />
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-4">
                        <x-input-label for="excerpt" :value="__('Kutipan Singkat (opsional)')" />
                        <textarea id="excerpt" name="excerpt" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('excerpt') }}</textarea>
                        <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <x-input-label for="content-editor" :value="__('Konten Lengkap')" />
                        {{-- Kita berikan ID unik pada textarea ini --}}
                        <textarea id="content" name="content" rows="15"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div class="mb-4">
                        <x-input-label for="published_at" :value="__('Tanggal Publikasi (opsional)')" />
                        <x-text-input id="published_at" name="published_at" type="datetime-local"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <x-input-label for="image_url" :value="__('Gambar (opsional)')" />
                        <input type="file" id="image_url" name="image_url"
                            class="block mt-1 w-full text-sm text-gray-500 file:bg-gray-800 file:text-white file:rounded file:px-4 file:py-2 file:border-0" />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>

                    <!-- Status Aktif -->
                    <div class="mb-4">
                        <x-input-label for="is_active" :value="__('Status')" />
                        <select id="is_active" name="is_active"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('admin.artikel.index') }}"
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
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript' , '|',
                'alignment', '|',
                'bulletedList', 'numberedList', 'link', 'blockQuote', '|',
                'undo', 'redo'
            ],
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
            placeholder: 'Tulis konten artikel di sini...' 
        })
        .catch(error => {
            console.error(error);
        });
</script>