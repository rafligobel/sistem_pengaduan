<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold">Langkah 2: Data Pengaduan</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Jelaskan pengaduan Anda secara rinci.</p>
    </div>

    <form method="POST" action="{{ route('complaint.public.step2.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="title" value="Judul Pengaduan" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" value="Kategori Pengaduan" />
            <select name="category_id" id="category_id"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="content" value="Isi Pengaduan" />
            <textarea id="content" name="content"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                rows="5">{{ old('content') }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="attachment" value="Lampiran (Opsional - PDF, JPG, PNG)" />
            {{-- Ini adalah styling input file yang lebih modern --}}
            <input id="attachment"
                class="block w-full text-sm text-gray-500 dark:text-gray-300
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-lg file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-50 dark:file:bg-indigo-800
                       file:text-indigo-700 dark:file:text-indigo-200
                       hover:file:bg-indigo-100 dark:hover:file:bg-indigo-700
                       transition duration-150 ease-in-out"
                type="file" name="attachment" />
            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
        </div>


        <div class="flex items-center justify-between mt-6">
            {{-- Link "Kembali" dibuat lebih jelas seperti tombol sekunder --}}
            <a class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                href="{{ route('complaint.public.step1.create') }}">
                &laquo; Kembali
            </a>
            <x-primary-button>
                Kirim Pengaduan
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
